<?php

namespace App\Http\Controllers\Admin;

use App\Http\Middleware\CheckAdminPermit;
use Yeosz\LaravelCurd\ApiException;
use App\Http\Requests\Admin\MenuRequest;
use App\Models\Menu;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Route;

class MenuController extends CommonController
{
    /**
     * 模型
     *
     * @var string
     */
    protected $model = Menu::class;

    /**
     * 模板
     *
     * @var array
     */
    protected $view = [
        'create' => 'admin.menu.form',
        'edit' => 'admin.menu.form',
    ];

    /**
     * 首页
     *
     * @return View
     */
    public function index()
    {
        $tree = $this->getTreeList('parent_id', 'sort', $this->model);

        return $this->xView('routes', $this->getRoutes())
            ->xView('tree', $tree)
            ->xView('admin.page.menu');
    }

    /**
     * 节点
     *
     * @return JsonResponse
     */
    public function nodes()
    {
        $fields = ['menus.*', 'p.name as parent_name'];
        $query = Menu::leftJoin('menus as p', 'menus.parent_id', '=', 'p.id')->select($fields);
        $nodes = $this->getTreeList('menus.parent_id', 'menus.sort', $query);

        return $this->responseData($nodes);
    }

    /**
     * 新增
     *
     * @param MenuRequest $request
     * @return View|JsonResponse
     */
    public function store(MenuRequest $request)
    {
        return $this->xStore($request);
    }

    /**
     * 修改
     *
     * @param $id
     * @param MenuRequest $request
     * @return JsonResponse
     */
    public function update($id, MenuRequest $request)
    {
        return $this->xUpdate($id, $request);
    }

    /**
     * 删除
     *
     * @param $id
     * @return JsonResponse
     * @throws ApiException
     */
    public function delete($id)
    {
        $exists = Menu::where('parent_id', $id)->exists();

        if ($exists) {
            throw new ApiException('存在子菜单，不允许删除');
        }

        return $this->xDelete($id);
    }

    /**
     * 获取路由
     *
     * @return array
     */
    protected function getRoutes()
    {
        $except = CheckAdminPermit::PERMITS;
        $routes = Route::getRoutes();
        $names = [];
        foreach ($routes as $route) {
            $name = $route->getName();
            if (isset($except[$name])) continue;
            if (substr($name, 0, 6) == 'admin.') {
                $names[] = $name;
            }
        }
        return $names;
    }
}