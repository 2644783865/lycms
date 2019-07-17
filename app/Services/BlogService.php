<?php

namespace App\Services;

use App\Models\Ad;
use App\Models\Attribute;
use App\Models\Content;
use App\Models\ContentAttribute;
use App\Models\Form;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

/**
 * Class BlogService
 * @package App\Services
 */
class BlogService extends CmsBaseService
{
    /**
     * @var string
     */
    const FORM_CODE = 'blog';

    /**
     * @var string
     */
    const ATTRIBUTE_CATEGORY = 'blog_category';

    /**
     * @var string
     */
    const ATTRIBUTE_TAG = 'blog_tag';

    /**
     * BlogService constructor.
     *
     * @param string $code
     */
    public function __construct($code = self::FORM_CODE)
    {
        parent::__construct($code);
    }

    /**
     * 最新
     *
     * @param int $limit
     * @return Collection
     */
    public function getNew($limit = 10)
    {
        $articles = $this->getModel()->orderBy('created_at', 'desc')->limit($limit)->get();
        foreach ($articles as $article) {
            /** @var Content $article */
            $article->setAttribute('attr_map', $article->attr_map);
        }
        return $articles;
    }

    /**
     * 置顶
     *
     * @param int $limit
     * @return Collection
     */
    public function getTop($limit = 10)
    {
        $list = $this->getModel()->where('top', '>', 0)->orderBy('top', 'desc')->limit($limit)->get();

        return $list;
    }

    /**
     * 热门
     *
     * @param int $limit
     * @return Collection
     */
    public function getHot($limit = 10)
    {
        $list = $this->getModel()->orderBy('page_view', 'desc')->limit($limit)->get();

        return $list;
    }

    /**
     * 获取分类root
     *
     * @return int
     */
    public function getCategoryRootId()
    {
        $attribute = Attribute::where('code', self::ATTRIBUTE_CATEGORY)->first();
        $rootId = $attribute->tree_id ?? 0;
        return $rootId;
    }

    /**
     * 分类过滤
     *
     * @param int|array $category
     * @return $this
     */
    public function filterByCategory($category)
    {
        $attributeId = Attribute::getIdByCode(self::ATTRIBUTE_CATEGORY);
        $contentIds = ContentAttribute::where('attribute_id', $attributeId)
            ->when(is_array($category), function (Builder $query) use ($category) {
                $query->whereIn('attribute_value', $category);
            }, function (Builder $query) use ($category) {
                $query->where('attribute_value', $category);
            })->pluck('content_id')
            ->toArray();

        $this->query = $this->query->whereIn('id', $contentIds);

        return $this;
    }

    /**
     * 标签过滤
     *
     * @param string $tag
     * @return $this
     */
    public function filterByTag($tag)
    {
        $attributeId = Attribute::getIdByCode(self::ATTRIBUTE_TAG);
        $contentIds = ContentAttribute::where('attribute_id', $attributeId)
            ->whereRaw("find_in_set('{$tag}',attribute_value)>0")
            ->pluck('content_id')
            ->toArray();
        $this->query = $this->query->whereIn('id', $contentIds);
        return $this;
    }

    /**
     * 详情接口
     *
     * @param $id
     * @return null|Content
     */
    public function getDetail($id)
    {
        /** @var Content $content */
        $content = $this->getModel()->find($id);
        if (!$content) {
            return null;
        }

        $prev = $this->getModel()->where('id', '<', $content->id)->first();
        $next = $this->getModel()->where('id', '>', $content->id)->first();
        $attrMap = $content->attr_map;
        $tags = $this->splitTags($attrMap[self::ATTRIBUTE_TAG]);

        $content->setAttribute('attributes', $content->attributes);
        $content->setAttribute('attr_map', $attrMap);
        $content->setAttribute('prev', $prev);
        $content->setAttribute('next', $next);
        $content->setAttribute('tags', $tags);
        //($content->toArray());die;
        return $content;
    }

    /**
     * 获取摘要
     *
     * @param $html
     * @return string
     */
    public function makeSummary($html)
    {
        $content = strip_tags($html);
        $content = trim($content);
        $patternArr = array('/\s/', '/ /');
        $replaceArr = array('', '');
        $content = preg_replace($patternArr, $replaceArr, $content);
        $content = mb_strcut($content, 0, 200, 'utf-8');
        return $content;
    }

    /**
     *
     *
     * @param $tags
     * @return array
     */
    public function splitTags($tags)
    {
        $tags = empty($tags) ? [] : explode(',', $tags);
        return $tags;
    }
}