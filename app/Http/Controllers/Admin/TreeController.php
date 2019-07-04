<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\TreeRequest;
use Illuminate\Http\Request;
use Yeosz\LaravelCurd\ApiException;
use App\Models\Tree;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class TreeController extends CommonController
{
    /**
     * 模型
     *
     * @var string
     */
    protected $model = Tree::class;

    /**
     * 模板
     *
     * @var array
     */
    protected $view = [
        'create' => 'admin.tree.form',
        'edit' => 'admin.tree.form',
    ];

    /**
     * 首页
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {
        $rootId = $request->input('root_id', 0);

        $trees = Tree::where('root_id', 0)->get();

        if ($trees->count()) {
            $tree = Tree::where('parent_id', 0)->find($rootId);
            if (!$tree) {
                $tree = $trees->first();
            }
        }

        return $this->xView('trees', $trees)->xView('root', $tree ?? null, false)->xView('admin.page.tree');
    }

    /**
     * 获取树nodes
     *
     * @param $id
     * @return JsonResponse
     */
    public function nodes($id)
    {
        /** @var Tree $root */
        $root = Tree::withTrashed()->where('parent_id', 0)->find($id);
        if (!$root) {
            return $this->responseData([]);
        }
        $depth = substr_count($root->level, ',') + 1;
        $fields = [
            'trees.id',
            'trees.root_id',
            'trees.parent_id',
            'trees.name',
            'trees.sort',
            'trees.status',
            'trees.depth',
            'trees.remark',
            'trees.created_at',
            'p.name as parent_name',
            \DB::raw("{$depth} as max_depth"),
        ];
        $query = Tree::leftJoin('trees as p', 'trees.parent_id', '=', 'p.id')
            ->where('trees.root_id', $id)
            ->select($fields);

        $nodes = $this->getTreeList('trees.parent_id', 'trees.sort', $query);

        return $this->responseData($nodes);
    }

    /**
     * 新增或修改root
     *
     * @param TreeRequest $request
     * @return JsonResponse
     */
    public function root(TreeRequest $request)
    {
        $rootId = $request->input('root_id', 0);
        $new = $request->correct();

        if ($rootId) {
            $root = Tree::where('parent_id', 0)->find($rootId);
            if (!$root) {
                return $this->responseError(ApiException::ERROR_NOT_FOUND, '数据不存在');
            }
            $root->update($request->correct());
        } else {
            $new['root_id'] = $new['parent_id'] = 0;
            $new['status'] = 1;
            $root = Tree::create($new);
        }

        return $this->responseData($root);
    }

    /**
     * 新增
     *
     * @param TreeRequest $request
     * @return JsonResponse
     * @throws ApiException
     */
    public function store(TreeRequest $request)
    {
        $new = $request->correct();
        $parent = Tree::find($new['parent_id']);

        if (!$parent) {
            throw new ApiException('父级不存在');
        }

        $new['root_id'] = $parent->root_id > 0 ? $parent->root_id : $parent->id;
        $new['parent_id'] = $parent->root_id > 0 ? $parent->id : 0;
        $new['depth'] = $parent->depth + 1;
        $new['path'] = $parent->root_id == 0 ? '' : trim($parent->path . ',' . $parent->id, ',');

        return $this->xStore($new);
    }

    /**
     * 详情
     *
     * @param $id
     * @return JsonResponse
     */
    public function show($id)
    {
        return $this->xShow($id);
    }

    /**
     * 修改
     *
     * @param $id
     * @param TreeRequest $request
     * @return JsonResponse
     */
    public function update($id, TreeRequest $request)
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
        $exists = Tree::where('parent_id', $id)->exists();

        if ($exists) {
            throw new ApiException('存在子项，不允许删除');
        }

        return $this->xDelete($id);
    }
}