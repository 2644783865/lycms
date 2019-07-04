<?php

namespace App\Http\Controllers\Admin;

use App\Models\Attribute;
use App\Models\Form;
use App\Models\FormAttribute;
use App\Http\Requests\Admin\FormAttributeRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Yeosz\LaravelCurd\ApiException;

class FormAttributeController extends CommonController
{
    /**
     * 模型
     *
     * @var string
     */
    protected $model = FormAttribute::class;

    /**
     * 更新的接口
     *
     * @param $id
     * @param FormAttributeRequest $request
     * @return JsonResponse
     */
    public function update($id, FormAttributeRequest $request)
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


    /**
     * 待选属性列表
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function unselected(Request $request)
    {
        $formId = $request->input('form_id');
        $ids = FormAttribute::where('form_id', $formId)->pluck('attribute_id')->toArray();
        $fields = [
            'id as attribute_id',
            'code as attribute_code',
            'name as attribute_name',
            'alias_name',
            'input',
        ];
        $attributes = Attribute::whereNotIn('id', $ids)->orderBy('input', 'asc')->get($fields);
        foreach ($attributes as $attribute) {
            $attribute->input_name = Attribute::INPUT[$attribute->input] ?? '';
        }
        return $this->responseData($attributes);
    }

    /**
     * 添加属性
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function addAttribute(Request $request)
    {
        $formId = $request->input('form_id');
        $attributeIds = $this->getRequestParamIds($request, true, 'attribute_ids');

        $form = Form::find($formId);
        if (!$form) {
            return $this->responseError(ApiException::ERROR_NOT_FOUND, '数据不存在');
        }

        $new = [
            'form_id' => $formId,
            'attribute_id' => 0,
            'sort' => 0,
            'required' => 2,
            'deleted_at' => null,
        ];
        $newRows = [];
        foreach ($attributeIds as $attributeId) {
            $new['attribute_id'] = $attributeId;
            $formAttribute = FormAttribute::withTrashed()->where('form_id', $formId)->where('attribute_id', $attributeId)->first();
            if ($formAttribute && $formAttribute->deleted_at) {
                FormAttribute::withTrashed()->whereId($formAttribute->id)->update($new);
            } elseif (!$formAttribute) {
                $newRows[] = $new;
            }
        }

        if (!empty($newRows)) {
            FormAttribute::insert($newRows);
        }

        return $this->responseSuccess();
    }
}