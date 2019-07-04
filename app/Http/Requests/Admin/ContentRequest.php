<?php

namespace App\Http\Requests\Admin;

use App\Models\Attribute;
use App\Models\Form;
use Yeosz\LaravelCurd\ApiRequest;

class ContentRequest extends ApiRequest
{
    protected $form_rules = [];

    protected $form_attributes = [];

    /**
     * 验证规则
     *
     * @return array
     */
    public function rules()
    {
        $formId = $this->input('form_id', 0);
        $this->initFormRequest($formId);

        $formRules = $this->form_rules[$formId] ?? [];
        $default = [
            'form_id' => 'required',
            'title' => 'required',
            'status' => 'required|in:1,2',
        ];
        $rules = array_merge($formRules, $default);
        return $rules;
    }

    /**
     * 表单属性
     *
     * @return array
     */
    public function attributes()
    {
        $formId = $this->input('form_id', 0);
        $this->initFormRequest($formId);
        $attributes = $this->form_attributes[$formId] ?? [];

        return $attributes;
    }

    /**
     * 初始化
     *
     * @param $formId
     * @return bool
     */
    protected function initFormRequest($formId)
    {
        if (!empty($this->form_attributes[$formId])) {
            return true;
        }

        $form = Form::find($formId);
        $rules = $attr = [];
        if (!$form) {
            return false;
        }

        foreach ($form->attr_details as $formAttribute) {
            $attr[$formAttribute->code] = $formAttribute->alias_name;
            // 验证规则
            $rule = [];
            if ($formAttribute->required == 1) {
                $rule[] = 'required';
            }
            $rule = Attribute::getInputRules($formAttribute->input, $rule);
            if (!empty($rule)) {
                $rules[$formAttribute->code] = $rule;
            }
        }

        $this->form_rules[$formId] = $rules;
        $this->form_attributes[$formId] = $attr;
    }
}
