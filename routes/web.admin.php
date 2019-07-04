<?php

Route::group(['namespace' => 'Admin'], function () {
    // 不需要登录
    Route::get('/admin/login', 'LoginController@showLoginForm')->name('admin.login');
    Route::post('/admin/login', 'LoginController@login');
    Route::get('/admin/logout', 'LoginController@logout')->name('admin.logout');

    // 需要登录的路由
    Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth']], function () {

        // 首页
        Route::get('/', 'IndexController@index')->name('admin.index');
        Route::post('/upload', 'IndexController@upload')->name('admin.upload');
        Route::get('/trees/{id}.json', 'IndexController@json')->name('admin.tree.json');

        // 个人中心
        Route::get('/profile', 'AdminController@profile')->name('admin.profile');
        Route::post('/profile/{id}', 'AdminController@updateProfile')->name('admin.profile.update');

        // 编辑器
        Route::post('/editor/upload', 'KindEditorController@upload')->name('admin.editor.upload');
        Route::get('/editor/system', 'KindEditorController@system')->name('admin.editor.system');

        // 配置管理
        Route::get('/configs', 'ConfigController@index')->name('admin.config');
        Route::post('/configs', 'ConfigController@update')->name('admin.config.update');

        // 用户管理
        Route::get('/admins', 'AdminController@index')->name('admin.admin');
        Route::get('/admins/create', 'AdminController@create')->name('admin.admin.create');
        Route::post('/admins/create', 'AdminController@store')->name('admin.admin.store');
        Route::get('/admins/{id}', 'AdminController@show')->name('admin.admin.show');
        Route::post('/admins/{id}', 'AdminController@update')->name('admin.admin.update');
        Route::delete('/admins/{id}', 'AdminController@delete')->name('admin.admin.delete');

        // 菜单管理
        Route::get('/menus', 'MenuController@index')->name('admin.menu');
        Route::get('/menus/nodes', 'MenuController@nodes')->name('admin.menu.nodes');
        Route::post('/menus/create', 'MenuController@store')->name('admin.menu.store');
        Route::post('/menus/{id}', 'MenuController@update')->name('admin.menu.update');
        Route::delete('/menus/{id}', 'MenuController@delete')->name('admin.menu.delete');

        // 广告位管理
        Route::get('/ad-positions', 'AdPositionController@index')->name('admin.ad-position');
        Route::post('/ad-positions/{id}', 'AdPositionController@update')->name('admin.ad-position.update');
        Route::post('/ad-positions/{id}/status', 'AdPositionController@updateStatus')->name('admin.ad-position.status');
        Route::delete('/ad-positions/{id}', 'AdPositionController@delete')->name('admin.ad-position.delete');

        // 广告管理
        Route::get('/ads', 'AdController@index')->name('admin.ad');
        Route::get('/ads/create', 'AdController@create')->name('admin.ad.create');
        Route::post('/ads/create', 'AdController@store')->name('admin.ad.store');
        Route::get('/ads/{id}', 'AdController@show')->name('admin.ad.show');
        Route::post('/ads/{id}', 'AdController@update')->name('admin.ad.update');
        Route::post('/ads/{id}/status', 'AdController@updateStatus')->name('admin.ad.status');
        Route::delete('/ads/{id}', 'AdController@delete')->name('admin.ad.delete');

        // 属性管理
        Route::get('/attributes', 'AttributeController@index')->name('admin.attribute');
        Route::get('/attributes/create', 'AttributeController@create')->name('admin.attribute.create');
        Route::post('/attributes/create', 'AttributeController@store')->name('admin.attribute.store');
        Route::get('/attributes/{id}', 'AttributeController@show')->name('admin.attribute.show');
        Route::post('/attributes/{id}', 'AttributeController@update')->name('admin.attribute.update');
        Route::post('/attributes/{id}/status', 'AttributeController@updateStatus')->name('admin.attribute.status');
        Route::delete('/attributes/{id}', 'AttributeController@delete')->name('admin.attribute.delete');

        // 表单管理
        Route::get('/forms', 'FormController@index')->name('admin.form');
        Route::get('/forms/{id}', 'FormController@show')->name('admin.form.show');
        Route::post('/forms/create', 'FormController@store')->name('admin.form.store');
        Route::post('/forms/{id}', 'FormController@update')->name('admin.form.update');
        Route::delete('/forms/{id}', 'FormController@delete')->name('admin.form.delete');

        // 表单属性
        Route::get('/forms-attributes/unselected', 'FormAttributeController@unselected')->name('admin.form-attribute.unselected');
        Route::post('/form-attributes/create', 'FormAttributeController@addAttribute')->name('admin.form-attribute.store');
        Route::post('/form-attributes/{id}', 'FormAttributeController@update')->name('admin.form-attribute.update');
        Route::delete('/form-attributes/{id}', 'FormAttributeController@delete')->name('admin.form-attribute.delete');

        // 内容管理
        Route::get('/contents', 'ContentController@index')->name('admin.content');
        Route::get('/contents/create', 'ContentController@create')->name('admin.content.create');
        Route::post('/contents/create', 'ContentController@store')->name('admin.content.store');
        Route::get('/contents/{id}', 'ContentController@show')->name('admin.content.show');
        Route::post('/contents/{id}', 'ContentController@update')->name('admin.content.update');
        Route::post('/contents/{id}/status', 'ContentController@updateStatus')->name('admin.content.status');
        Route::post('/contents/{id}/top', 'ContentController@updateTop')->name('admin.content.top');
        Route::delete('/contents/{id}', 'ContentController@delete')->name('admin.content.delete');

        // 树管理
        Route::get('/trees', 'TreeController@index')->name('admin.tree');
        Route::get('/trees/{id}/nodes', 'TreeController@nodes')->name('admin.tree.nodes');
        Route::post('/trees/root', 'TreeController@root')->name('admin.tree.root');
        Route::post('/trees/create', 'TreeController@store')->name('admin.tree.store');
        Route::get('/trees/{id}', 'TreeController@show')->name('admin.tree.show');
        Route::post('/trees/{id}', 'TreeController@update')->name('admin.tree.update');
        Route::delete('/trees/{id}', 'TreeController@delete')->name('admin.tree.delete');

    });
});