<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $guarded = ['id'];

    /**
     * @var array 站点配置
     */
    const CONFIG_SITE = [
        'code' => 'config_site',
        'name' => '站点配置',
        'column' => [
            ['name' => '网站名称', 'column' => 'name', 'rules' => 'required', 'placeholder' => ''],
            ['name' => '关键字', 'column' => 'keyword', 'rules' => 'required', 'placeholder' => '网站SEO关键字'],
            ['name' => '描述', 'column' => 'description', 'rules' => 'required', 'placeholder' => '网站SEO描述'],
        ],
    ];

    /**
     * @var array 邮箱配置
     */
    const CONFIG_EMAIL = [
        'code' => 'config_email',
        'name' => '邮箱配置',
        'column' => [
            ['name' => '发件人', 'column' => 'from_name', 'rules' => 'required', 'placeholder' => ''],
            ['name' => '邮箱地址', 'column' => 'smtp_user', 'rules' => 'required|email', 'placeholder' => ''],
            ['name' => '邮箱密码', 'column' => 'smtp_pass', 'rules' => 'required', 'placeholder' => ''],
            ['name' => 'SMTP服务器', 'column' => 'smtp_host', 'rules' => 'required', 'placeholder' => ''],
            ['name' => 'SMTP端口', 'column' => 'smtp_port', 'rules' => 'required|integer', 'placeholder' => ''],
        ],
    ];

    /**
     * @var array 所有配置
     */
    const CONFIG = [
        self::CONFIG_SITE,
        self::CONFIG_EMAIL,
    ];
}
