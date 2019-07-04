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
            'controller',
            'action',
            'icon',
            'show',
            'sort',
        ],
        'admin.menu.update' => [
            'name',
            'link',
            'controller',
            'action',
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
            'controller' => 'alpha_dash',
            'action' => 'alpha_dash',
        ];
        if (empty($this->id)) {
            $rules['parent_id'] = 'required|integer';
        }
        return $rules;
    }
}
