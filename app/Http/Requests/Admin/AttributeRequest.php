<?php

namespace App\Http\Requests\Admin;

use Yeosz\LaravelCurd\ApiRequest;

class AttributeRequest extends ApiRequest
{
    public $only = [
        'code',
        'name',
        'alias_name',
        'value',
        'tree_id',
        'status',
        'input',
        'unit',
        'placeholder',
        'remark',
    ];

    protected $protectedCodes = [
        'id',
        'form_id',
        'title',
        'cover',
        'status',
        'top',
        'page_view',
        'created_at',
        'updated_at',
        'deleted_at',
        'form',
        'attr_map',
        'attributes',
    ];

    protected $correct = [
        ['status', 'intval'],
        ['tree_id', 'intval'],
        ['code', 'strtolower'],
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $codes = 'not_in:' . implode(',', $this->protectedCodes);
        $rules = [
            'code' => [
                'unique:attributes,code',
                'required',
                $codes,
                'alpha',

            ],
            'name' => 'required',
            'alias_name' => 'required',
            'input' => 'required',
            'status' => 'required|in:1,2',
            'tree_id' => 'integer',
        ];
        if ($this->id) {
            $rules['code'][0] = 'unique:attributes,code,' . $this->id;
        }
        $input = $this->input('input', '');
        if (in_array($input, ['radio', 'checkbox'])) {
            $rules['value'] = 'required';
        }
        if ($input == 'tree') {
            $rules['tree_id'] = 'required';
        } else {
            $this->merge(['tree_id' => 0]);
        }
        return $this->xEditableRules($rules);
    }

    public function attributes()
    {
        return [
            'code' => '编码',
            'alias_name' => '别名',
            'value' => '备选值',
            'unit' => '单位',
            'input' => '输入类型',
            'tree_id' => '级联',
        ];
    }
}
