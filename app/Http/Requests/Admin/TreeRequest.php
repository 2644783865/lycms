<?php

namespace App\Http\Requests\Admin;

use Yeosz\LaravelCurd\ApiRequest;

class TreeRequest extends ApiRequest
{
    public $only = [
        'admin.tree.root' => [
            'name',
            'level',
        ],
        'admin.tree.store' => [
            'parent_id',
            'name',
            'sort',
            'status',
            'remark',
        ],
        'admin.tree.update' => [
            'name',
            'sort',
            'status',
            'remark',
        ],
    ];

    protected $correct = [
        ['parent_id', 'intval'],
        ['sort', 'intval'],
        ['depth', 'intval'],
        ['status', 'intval'],
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $routeName = $this->route()->getName();

        $rules = [
            'name' => 'required',
            'sort' => 'integer',
            'status' => 'integer',
        ];

        switch ($routeName) {
            case 'admin.tree.update':
                break;
            case 'admin.tree.store':
                $rules['parent_id'] = 'required';
                break;
            case 'admin.tree.root':
                $rules['level'] = 'required';
                $rules['root_id'] = 'integer';
                break;
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'parent_id' => '父级',
            'name' => '名称',
            'sort' => '排序',
            'status' => '状态',
            'level' => '层级名称',
            'remark' => '备注',
        ];
    }
}
