<?php

namespace App\Http\Controllers\Admin;

use App\Models\Form;
use App\Http\Requests\Admin\FormRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Yeosz\LaravelCurd\ApiException;

class FormController extends CommonController
{
    /**
     * 模型
     *
     * @var string
     */
    protected $model = Form::class;

    /**
     * 首页
     *
     * @param Request $request
     * @return JsonResponse|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $list = Form::get();
            return $this->responseData($list);
        } else {
            return view('admin.page.form');
        }
    }

    /**
     * 新增的接口
     *
     * @param FormRequest $request
     * @return JsonResponse
     */
    public function store(FormRequest $request)
    {
        return $this->xStore($request);
    }

    /**
     * 详情
     *
     * @param $id
     * @return JsonResponse
     * @throws ApiException
     */
    public function show($id)
    {
        return $this->xShow($id, [], ['attributes']);
    }

    /**
     * 更新的接口
     *
     * @param $id
     * @param FormRequest $request
     * @return JsonResponse
     */
    public function update($id, FormRequest $request)
    {
        return $this->xUpdate($id, $request);
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