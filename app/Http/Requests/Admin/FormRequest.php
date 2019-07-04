<?php

namespace App\Http\Requests\Admin;

use Yeosz\LaravelCurd\ApiRequest;

class FormRequest extends ApiRequest
{
    public $only = [
        'code',
        'name',
    ];

    protected $correct = [
        ['code', 'strtolower'],
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'code' => [
                'required',
                'unique:forms,code',
                'regex:/^[a-zA-Z][a-zA-Z0-9_]*$/',
            ],
            'name' => 'required',
        ];
        if (!empty($this->id)) {
            $rules['code'][1] = 'unique:forms,code,' . $this->id;
        }
        $rules = $this->xEditableRules($rules);
        return $rules;
    }

    public function attributes()
    {
        return [
            'code' => '编码',
        ];
    }
}
