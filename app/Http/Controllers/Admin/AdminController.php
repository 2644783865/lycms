<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use App\Models\Admin;
use App\Http\Requests\Admin\AdminRequest;
use Illuminate\Database\Eloquent\Builder;
use Yeosz\LaravelCurd\ApiException;

class AdminController extends CommonController
{
    /**
     * 模型
     *
     * @var string
     */
    protected $model = Admin::class;

    /**
     * 模板
     *
     * @var array
     */
    protected $view = [
        'create' => 'admin.admin.form',
        'edit' => 'admin.admin.form',
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
        $pageSize = $request->input('page_size', self::PAGE_SIZE);

        $list = Admin::when($keyword, function (Builder $query) use ($keyword) {
            $query->where(function (Builder $query) use ($keyword) {
                $query->where('name', 'like', "%{$keyword}%")->orWhere('email', 'like', "%{$keyword}%");
            });
        })->orderBy('id', 'asc')
            ->paginate($pageSize);

        return $this->xView('page', $list)->xView('admin.admin.index');
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
     * 新增
     *
     * @param AdminRequest $request
     * @return JsonResponse
     */
    public function store(AdminRequest $request)
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
     * 修改
     *
     * @param $id
     * @param AdminRequest $request
     * @return JsonResponse
     */
    public function update($id, AdminRequest $request)
    {
        return $request->has(['pk', 'name', 'value']) ? $this->xUpdateColumn($id, $request) : $this->xUpdate($id, $request);
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
        if ($id == $this->admin()->id) {
            throw new ApiException('不能删除当前帐号');
        }
        return $this->xDelete($id);
    }

    /**
     * 个人信息
     *
     * @return View
     */
    public function profile()
    {
        $id = $this->admin()->id;
        $this->xView('page_title', '个人信息')->xView('api', route('admin.profile.update', ['id' => $id]));
        return $this->show($id);
    }

    /**
     * 更新个人信息
     *
     * @param $id
     * @param AdminRequest $request
     * @return JsonResponse
     * @throws ApiException
     */
    public function updateProfile($id, AdminRequest $request)
    {
        $adminId = $this->admin()->id;

        if ($id != $adminId) {
            throw new ApiException('修改失败');
        }

        return $this->update($id, $request);
    }
}
