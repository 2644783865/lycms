<?php

namespace App\Http\Requests\Admin;

use Yeosz\LaravelCurd\ApiRequest;

class AdPositionRequest extends ApiRequest
{
    public $only = [
        'name',
        'remark',
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
        ];

        return $this->xEditableRules($rules);
    }
}
