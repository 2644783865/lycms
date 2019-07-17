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
        if (empty($this->id)) {
            $rules = [
                'name' => 'required|unique:ad_positions,name',
            ];
        } else {
            $rules = [
                'name' => 'required|unique:ad_positions,name,' . $this->id,
            ];
        }
        return $this->xEditableRules($rules);
    }
}
