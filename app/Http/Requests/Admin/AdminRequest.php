<?php

namespace App\Http\Requests\Admin;

use Yeosz\LaravelCurd\ApiRequest;

class AdminRequest extends ApiRequest
{

    public $only = [
        'name',
        'email',
        'password',
        'avatar'
    ];

    protected $correct = [
        ['password', 'unset'],
        ['password', 'password'],
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
            'email' => 'required|email|unique:admins,email',
            'avatar' => 'required',
            'password' => 'min:6',
        ];
        if (empty($this->id)) {
            $rules['password'] = 'required|min:6';
        } else {
            $rules['email'] = 'required|email|unique:admins,email,' . $this->id;
        }
        return $this->xEditableRules($rules);
    }
}
