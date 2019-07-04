<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ad;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\Admin\AdRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class AdController extends CommonController
{
    /**
     * 模型
     *
     * @var string
     */
    protected $model = Ad::class;

    /**
     * 模板
     *
     * @var array
     */
    protected $view = [
        'create' => 'admin.ad.form',
        'edit' => 'admin.ad.form',
    ];

    /**
     * 首页
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {
        $positionId = $request->input('position_id', 0);
        $pageSize = $request->input('page_size', self::PAGE_SIZE);

        $list = Ad::leftJoin('ad_positions', 'ads.position_id', '=', 'ad_positions.id')
            ->when($positionId, function (Builder $query) use ($positionId) {
                $query->where('ads.position_id', $positionId);
            })->paginate($pageSize, ['ads.*', 'ad_positions.name AS ad_position_name']);

        return $this->xView('page', $list)->xView('admin.ad.index');
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
     * @param AdRequest $request
     * @return JsonResponse
     */
    public function store(AdRequest $request)
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
     * @param AdRequest $request
     * @return JsonResponse
     */
    public function update($id, AdRequest $request)
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
     */
    public function delete($id)
    {
        return $this->xDelete($id);
    }
}