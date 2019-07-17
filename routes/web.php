<?php

// 前台页面的路由
Route::get('/', function () {
    return view('welcome');
});

// 后台的路由
require_once __DIR__ . '/web.admin.php';
require_once __DIR__ . '/web.blog.php';
require_once __DIR__ . '/web.company.php';
