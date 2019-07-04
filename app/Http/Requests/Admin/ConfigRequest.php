<?php

namespace App\Http\Requests\Admin;

use App\Models\Config;
use Yeosz\LaravelCurd\ApiException;
use Yeosz\LaravelCurd\ApiRequest;

class ConfigRequest extends ApiRequest
{
    /**
     * @var array
     */
    protected $config = [];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $config = $this->getConfig();
        $keys = array_column($config['column'], 'column');
        $values = array_column($config['column'], 'rules');
        $rules = array_combine($keys, $values);
        array_filter($rules);
        return $rules;
    }

    public function attributes()
    {
        $config = $this->getConfig();
        $keys = array_column($config['column'], 'column');
        $values = array_column($config['column'], 'name');
        $attributes = array_combine($keys, $values);
        return $attributes;
    }

    /**
     * 获取配置
     *
     * @return mixed
     * @throws \Exception
     */
    protected function getConfig()
    {
        if ($this->config) {
            return $this->config;
        }
        $code = $this->input('_config_code', '');
        if (empty($code)) {
            throw new ApiException('请求异常');
        }
        $const = 'App\Models\Config::' . strtoupper($code);
        if (!defined($const)) {
            throw new ApiException('配置项不存在');
        }
        $this->config = constant($const);
        return $this->config;
    }
}
