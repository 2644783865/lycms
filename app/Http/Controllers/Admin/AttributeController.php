<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\AttributeRequest;
use App\Models\Attribute;
use App\Models\FormAttribute;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Yeosz\LaravelCurd\ApiException;

class AttributeController extends CommonController
{
    /**
     * 模型
     *
     * @var string
     */
    protected $model = Attribute::class;

    /**
     * 模板
     *
     * @var array
     */
    protected $view = [
        'create' => 'admin.attribute.form',
        'edit' => 'admin.attribute.form',
    ];

    /**
     * 首页
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword', '');
        $input = $request->input('input', '');
        $pageSize = $request->input('page_size', self::PAGE_SIZE);

        $list = Attribute::when($keyword, function (Builder $query) use ($keyword) {
            $query->where('code', 'like', "%$keyword%")
                ->orWhere('name', 'like', "%$keyword%")
                ->orWhere('alias_name', 'like', "%$keyword%");
        })->when($input, function (Builder $query) use ($input) {
            $query->where('input', $input);
        })->paginate($pageSize);

        return $this->xView('page', $list)->xView('admin.attribute.index');
    }

    /**
     * 新增页
     *
     * @return View
     */
    public function create()
    {
        return $this->xCreate();
    }

    /**
     * 新增的接口
     *
     * @param AttributeRequest $request
     * @return JsonResponse
     */
    public function store(AttributeRequest $request)
    {
        return $this->xStore($request);
    }

    /**
     * 编辑页
     *
     * @param $id
     * @return View
     */
    public function show($id)
    {
        return $this->xEdit($id);
    }

    /**
     * 更新的接口
     *
     * @param $id
     * @param AttributeRequest $request
     * @return JsonResponse
     */
    public function update($id, AttributeRequest $request)
    {
        return $this->xUpdate($id, $request);
    }

    /**
     * 更新状态的接口
     *
     * @param $id
     * @return JsonResponse
     */
    public function updateStatus($id)
    {
        return $this->xToggleColumn($id, 'status', [1, 2]);
    }

    /**
     * 删除的接口
     *
     * @param $id
     * @return JsonResponse
     * @throws ApiException
     */
    public function delete($id)
    {
        if (FormAttribute::where('attribute_id', $id)->exists()) {
            throw new ApiException('使用中的属性不能删除');
        }
        return $this->xDelete($id);
    }
}