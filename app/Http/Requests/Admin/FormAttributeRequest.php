<?php

namespace App\Http\Requests\Admin;

use Yeosz\LaravelCurd\ApiRequest;

class FormAttributeRequest extends ApiRequest
{
    public $only = [
        'sort',
        'required',
        'show',
    ];

    protected $correct = [
        ['sort', 'intval'],
        ['required', 'intval'],
        ['show', 'intval'],
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'sort' => 'integer',
            'required' => 'in:1,2',
            'show' => 'in:1,2',
        ];

        return $rules;
    }

    public function attributes()
    {
        return [
            'sort' => '排序',
            'required' => '必填',
        ];
    }
}
