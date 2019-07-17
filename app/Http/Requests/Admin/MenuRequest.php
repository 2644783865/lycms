<?php

namespace App\Http\Requests\Admin;

use Yeosz\LaravelCurd\ApiRequest;

class MenuRequest extends ApiRequest
{
    public $only = [
        'admin.menu.store' => [
            'parent_id',
            'name',
            'link',
            'route',
            'icon',
            'show',
            'sort',
        ],
        'admin.menu.update' => [
            'name',
            'link',
            'route',
            'icon',
            'show',
            'sort',
        ],
    ];

    protected $correct = [
        ['parent_id', 'intval'],
        ['sort', 'intval'],
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
            'name' => 'required',
            'sort' => 'integer',
            'route' => [
                'regex:/^[a-zA-Z.-_]*$/',
            ],
        ];
        if (empty($this->id)) {
            $rules['parent_id'] = 'required|integer';
        }
        $route = $this->input('route', '');
        if ($route) {
            $rules['route'][] = $this->id ? ('unique:menus,route,' . $this->id) : 'unique:menus,route';
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'route' => '权限',
            'sort' => '排序',
        ];
    }
}
