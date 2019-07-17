<?php

namespace App\Services;

use App\Models\Ad;
use App\Models\Attribute;
use App\Models\Content;
use App\Models\ContentAttribute;
use App\Models\Form;
use App\Models\Tree;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

/**
 * Class CompanyService
 * @package App\Services
 */
class CompanyService extends CmsBaseService
{
    const FORM_CASE = 'case';

    const FORM_NEWS = 'news';

    const ATTRIBUTE_CATEGORY = 'company_category';

    /**
     * @var CmsBaseService $case
     */
    public $case;

    /**
     * CompanyService constructor.
     * @param string $code
     */
    public function __construct($code = self::FORM_NEWS)
    {
        parent::__construct($code);
        $this->case = new CmsBaseService(self::FORM_CASE);
    }

    /**
     * 获取子类
     *
     * @param $name
     * @return array
     */
    public function getSubCategories($name)
    {
        $parent = Tree::where('name', $name)->where('depth', 1)->first();
        $result = $parent ? Tree::whereParentId($parent->id)->whereStatus(1)->get()->toArray() : [];
        return $result;
    }

    /**
     * 获取置顶
     *
     * @param $form
     * @param $limit
     * @return mixed
     */
    public function getTopContent($form, $limit)
    {
        $model = $form == 'case' ? $this->case->getModel() : $this->getModel();
        $list = $model->where('top', '>', 0)->limit($limit)->orderBy('top', 'desc')->get();
        foreach ($list as $item) {
            /** @var Content $article */
            $item->setAttribute('attr_map', $item->attr_map);
        }
        return $list;
    }

    /**
     * 分类过滤
     *
     * @param int $id
     * @return array
     */
    public function getIdsByCategory($id)
    {
        $attributeId = Attribute::getIdByCode(self::ATTRIBUTE_CATEGORY);
        $contentIds = ContentAttribute::where('attribute_id', $attributeId)
            ->where('attribute_value', $id)
            ->pluck('content_id')
            ->toArray();

        return $contentIds;
    }
}