<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\AdPositionRequest;
use App\Models\AdPosition;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class AdPositionController extends CommonController
{
    /**
     * 模型
     *
     * @var string
     */
    protected $model = AdPosition::class;

    /**
     * 首页
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {
        $name = $request->input('name', '');

        if (!empty($name)) {
            $new = [
                'name' => $name,
                'status' => 1,
            ];
            $this->xStore($new);

            return redirect(route('admin.ad-position'));
        }

        $list = AdPosition::get();

        return $this->xView('page', $list)->xView('admin.ad.position');
    }

    /**
     * 修改状态
     *
     * @param $id
     * @param AdPositionRequest $request
     * @return JsonResponse
     * @throws \Yeosz\LaravelCurd\ApiException
     */
    public function update($id, AdPositionRequest $request)
    {
        return $this->xUpdateColumn($id, $request);
    }

    /**
     * 修改状态
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
     */
    public function delete($id)
    {
        return $this->xDelete($id);
    }
}