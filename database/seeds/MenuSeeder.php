<?php

use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    protected $menus = [
        ["id" => 1, "parent_id" => 0, "name" => "首页", "link" => "/admins/", "controller" => "Index", "action" => "index", "icon" => "", "show" => 2, "sort" => 0],
        ["id" => 2, "parent_id" => 0, "name" => "系统设置", "link" => "", "controller" => "", "action" => "", "icon" => "mdi-settings", "show" => 1, "sort" => 1],
        ["id" => 3, "parent_id" => 0, "name" => "广告管理", "link" => "", "controller" => "", "action" => "", "icon" => "mdi-brightness-auto", "show" => 1, "sort" => 2],
        ["id" => 4, "parent_id" => 0, "name" => "内容管理", "link" => "", "controller" => "", "action" => "", "icon" => "mdi-content-copy", "show" => 1, "sort" => 3],
        ["id" => 5, "parent_id" => 2, "name" => "用户管理", "link" => "/admin/admins", "controller" => "AdminController", "action" => "index", "icon" => "", "show" => 1, "sort" => 1],
        ["id" => 6, "parent_id" => 2, "name" => "菜单管理", "link" => "/admin/menus", "controller" => "MenuController", "action" => "index", "icon" => "", "show" => 1, "sort" => 2],
        ["id" => 7, "parent_id" => 2, "name" => "配置管理", "link" => "/admin/configs", "controller" => "ConfigController", "action" => "index", "icon" => "", "show" => 1, "sort" => 3],
        ["id" => 8, "parent_id" => 3, "name" => "广告位置管理", "link" => "/admin/ad-positions", "controller" => "AdPositionController", "action" => "index", "icon" => "", "show" => 1, "sort" => 1],
        ["id" => 9, "parent_id" => 3, "name" => "广告", "link" => "/admin/ads", "controller" => "AdController", "action" => "index", "icon" => "", "show" => 1, "sort" => 2],
        ["id" => 10, "parent_id" => 4, "name" => "字段管理", "link" => "/admin/attributes", "controller" => "AttributeController", "action" => "index", "icon" => "", "show" => 1, "sort" => 1],
        ["id" => 11, "parent_id" => 4, "name" => "表单管理", "link" => "/admin/forms", "controller" => "FormController", "action" => "index", "icon" => "", "show" => 1, "sort" => 2],
        ["id" => 12, "parent_id" => 4, "name" => "级联管理", "link" => "/admin/trees", "controller" => "TreeController", "action" => "index", "icon" => "", "show" => 1, "sort" => 3],
        ["id" => 13, "parent_id" => 4, "name" => "内容管理", "link" => "/admin/contents", "controller" => "ContentController", "action" => "index", "icon" => "", "show" => 1, "sort" => 4],
        ["id" => 14, "parent_id" => 10, "name" => "新增字段", "link" => "/admin/attributes/create", "controller" => "AttributeController", "action" => "create", "icon" => "", "show" => 1, "sort" => 0],
        ["id" => 15, "parent_id" => 10, "name" => "编辑字段", "link" => "", "controller" => "AttributeController", "action" => "show", "icon" => "", "show" => 1, "sort" => 0],
        ["id" => 16, "parent_id" => 13, "name" => "新增内容", "link" => "/admin/contents/create", "controller" => "ContentController", "action" => "create", "icon" => "", "show" => 1, "sort" => 0],
        ["id" => 17, "parent_id" => 13, "name" => "编辑内容", "link" => "", "controller" => "ContentController", "action" => "show", "icon" => "", "show" => 1, "sort" => 0],
        ["id" => 18, "parent_id" => 5, "name" => "新增用户", "link" => "/admin/admins/create", "controller" => "AdminController", "action" => "create", "icon" => "", "show" => 1, "sort" => 0],
        ["id" => 19, "parent_id" => 5, "name" => "编辑用户", "link" => "", "controller" => "AdminController", "action" => "show", "icon" => "", "show" => 1, "sort" => 0],
        ["id" => 20, "parent_id" => 9, "name" => "新增广告", "link" => "/admin/ads/create", "controller" => "AdController", "action" => "create", "icon" => "", "show" => 1, "sort" => 0],
        ["id" => 21, "parent_id" => 9, "name" => "编辑广告", "link" => "", "controller" => "AdController", "action" => "show", "icon" => "", "show" => 1, "sort" => 0],
    ];

    /**
     * 初始化菜单
     * php artisan db:seed --class=MenuSeeder
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->delete();
        $now = date('Y-m-d H:i:s');
        $menus = [];
        foreach ($this->menus as $menu) {
            $menu['created_at'] = $menu['updated_at'] = $now;
            $menus[] = $menu;
        }
        DB::table('menus')->insert($menus);
    }
}
