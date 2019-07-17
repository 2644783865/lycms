<?php

namespace App\Services;

use App\Models\Ad;
use App\Models\Content;
use App\Models\Form;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

/**
 * Class CmsService
 * @package App\Services
 *
 * @method Builder|Content orderBy($column, $direction)
 * @method Builder|Content where($column, $operator = null, $value = null, $boolean = 'and')
 * @method Builder|Content whereIn($column, $values, $boolean = 'and', $not = false)
 * @method Builder|Content limit($value)
 * @method Builder|Content when($value, $callback, $default = null)
 * @method Builder|Content select($columns = array())
 * @method Builder|Content orWhere($column, $operator = null, $value = null)
 *
 */
class CmsBaseService
{
    /**
     * @var string
     */
    public $formCode;

    /**
     * @var Content $model
     */
    protected $model;

    /**
     * @var Builder $query
     */
    protected $query;

    /**
     * CmsBaseService constructor.
     *
     * @param $formCode
     */
    public function __construct($formCode)
    {
        $this->formCode = $formCode;
        $this->initQuery();
    }

    /**
     * 获取广告
     *
     * @param string $name 广告位名称
     * @param int $limit
     * @param bool $image
     * @return Ad|Collection
     */
    public function getAd($name, $limit = 0, $image = false)
    {
        $now = date('Y-m-d H:i:s');
        $query = Ad::leftJoin('ad_positions', 'ad_positions.id', '=', 'ads.position_id')
            ->where('ad_positions.name', $name)
            ->where('ad_positions.status', 1)
            ->where('ads.status', 1)
            ->where('ads.start_time', '<', $now)
            ->where('ads.end_time', '>', $now)
            ->orderBy('ads.sort', 'asc');
        if ($image) {
            $query = $query->where('image', '<>', '');
        }
        if ($limit == 1) {
            $ad = $query->first();
        } elseif ($limit) {
            $ad = $query->limit($limit)->get(['ads.*']);
        } else {
            $ad = $query->get();
        }

        return $ad;
    }

    /**
     * 分页
     *
     * @param int $pageSize
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($pageSize = 15)
    {
        $articles = $this->query->paginate($pageSize);

        foreach ($articles as $article) {
            /** @var Content $article */
            $article->setAttribute('attr_map', $article->attr_map);
        }
        $this->initQuery();

        return $articles;
    }

    /**
     * 查询
     *
     * @param array $columns
     * @return Collection
     */
    public function get($columns = ['*'])
    {
        $articles = $this->query->get($columns);

        foreach ($articles as $article) {
            /** @var Content $article */
            $article->setAttribute('attr_map', $article->attr_map);
        }
        $this->initQuery();

        return $articles;
    }

    /**
     * 初始化查询
     *
     */
    protected function initQuery()
    {
        $this->query = $this->getModel();
    }

    /**
     * 魔术方法
     *
     * @param $method
     * @param $args
     * @return $this|null
     */
    public function __call($method, $args)
    {
        if (in_array($method, ['orderBy', 'limit', 'select', 'where', 'orWhere', 'when', 'whereIn'])) {
            $this->query = call_user_func_array([$this->query, $method], $args);
            return $this;
        } elseif (in_array($method, ['get', 'pluck',])) {
            $this->query = call_user_func_array([$this->query, $method], $args);
            $this->initQuery();
            return $this;
        }
        return null;
    }

    /**
     * 查询
     *
     * @return Builder
     */
    public function getModel()
    {
        if (!$this->model) {
            $form = Form::whereCode($this->formCode)->first();
            $formId = $form ? $form->id : 0;
            $this->model = Content::whereFormId($formId)->where('status', 1);
        }
        $model = clone $this->model;
        return $model;
    }
}