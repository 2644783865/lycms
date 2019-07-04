<?php

namespace App\Http\Requests\Admin;

use Yeosz\LaravelCurd\ApiRequest;

class AdRequest extends ApiRequest
{
    public $only = [
        'position_id',
        'title',
        'subtitle',
        'image',
        'sort',
        'status',
        'target_type',
        'target',
        'start_time',
        'end_time',
    ];

    protected $correct = [
        ['sort', 'intval'],
        ['status', 'intval'],
        ['target_type', 'intval'],
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'position_id' => 'required|integer|min:1',
            'title' => 'required',
            'sort' => 'integer',
            'target_type' => 'integer',
            'target' => 'required',
            'status' => 'required|in:1,2',
            'start_time' => 'required|date',
            'end_time' => 'required|date',
        ];

        return $this->xEditableRules($rules);
    }

    public function attributes()
    {
        return [
            'position_id' => '广告位',
            'title' => '标题',
            'subtitle' => '副标题',
            'sort' => '排序',
            'target_type' => '链接类型',
            'target' => '链接内容',
            'start_time' => '投放时间',
            'end_time' => '投放时间',
        ];
    }
}
