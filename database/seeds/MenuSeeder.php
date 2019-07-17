<?php

use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    protected $menus = [
        ["id" => 1, "parent_id" => 0, "name" => "首页", "link" => "/admins/", "route" => "admin.index", "icon" => "", "show" => 2, "sort" => 0],
        ["id" => 2, "parent_id" => 0, "name" => "系统设置", "link" => "", "route" => "", "icon" => "mdi-settings", "show" => 1, "sort" => 1],
        ["id" => 3, "parent_id" => 0, "name" => "广告管理", "link" => "", "route" => "", "icon" => "mdi-brightness-auto", "show" => 1, "sort" => 2],
        ["id" => 4, "parent_id" => 0, "name" => "内容管理", "link" => "", "route" => "", "icon" => "mdi-content-copy", "show" => 1, "sort" => 3],
        ["id" => 5, "parent_id" => 2, "name" => "用户管理", "link" => "/admin/admins", "route" => "", "icon" => "", "show" => 1, "sort" => 1],
        ["id" => 6, "parent_id" => 2, "name" => "菜单管理", "link" => "/admin/menus", "route" => "admin.menu", "icon" => "", "show" => 1, "sort" => 2],
        ["id" => 7, "parent_id" => 2, "name" => "配置管理", "link" => "/admin/configs", "route" => "admin.config", "icon" => "", "show" => 1, "sort" => 3],
        ["id" => 8, "parent_id" => 3, "name" => "广告位管理", "link" => "/admin/ad-positions", "route" => "admin.ad-position", "icon" => "", "show" => 1, "sort" => 1],
        ["id" => 9, "parent_id" => 3, "name" => "广告管理", "link" => "/admin/ads", "route" => "", "icon" => "", "show" => 1, "sort" => 2],
        ["id" => 10, "parent_id" => 4, "name" => "字段管理", "link" => "/admin/attributes", "route" => "", "icon" => "", "show" => 1, "sort" => 1],
        ["id" => 11, "parent_id" => 4, "name" => "表单管理", "link" => "/admin/forms", "route" => "admin.form", "icon" => "", "show" => 1, "sort" => 3],
        ["id" => 12, "parent_id" => 4, "name" => "级联管理", "link" => "/admin/trees", "route" => "admin.tree", "icon" => "", "show" => 1, "sort" => 2],
        ["id" => 13, "parent_id" => 4, "name" => "内容管理", "link" => "/admin/contents", "route" => "", "icon" => "", "show" => 1, "sort" => 4],
        ["id" => 14, "parent_id" => 10, "name" => "字段列表", "link" => "/admin/attributes", "route" => "admin.attribute", "icon" => "", "show" => 1, "sort" => 0],
        ["id" => 15, "parent_id" => 10, "name" => "新增字段", "link" => "/admin/attributes/create", "route" => "admin.attribute.create", "icon" => "", "show" => 1, "sort" => 1],
        ["id" => 16, "parent_id" => 10, "name" => "编辑字段", "link" => "", "route" => "admin.attribute.show", "icon" => "", "show" => 1, "sort" => 2],
        ["id" => 17, "parent_id" => 10, "name" => "删除字段", "link" => "", "route" => "admin.attribute.delete", "icon" => "", "show" => 2, "sort" => 3],
        ["id" => 18, "parent_id" => 13, "name" => "内容列表", "link" => "/admin/contents", "route" => "admin.content", "icon" => "", "show" => 1, "sort" => 0],
        ["id" => 19, "parent_id" => 13, "name" => "新增内容", "link" => "/admin/contents/create", "route" => "admin.content.create", "icon" => "", "show" => 1, "sort" => 1],
        ["id" => 20, "parent_id" => 13, "name" => "编辑内容", "link" => "", "route" => "admin.content.show", "icon" => "", "show" => 1, "sort" => 2],
        ["id" => 21, "parent_id" => 13, "name" => "删除内容", "link" => "", "route" => "admin.content.delete", "icon" => "", "show" => 2, "sort" => 3],
        ["id" => 22, "parent_id" => 5, "name" => "用户列表", "link" => "/admin/admins", "route" => "admin.admin", "icon" => "", "show" => 2, "sort" => 0],
        ["id" => 23, "parent_id" => 5, "name" => "新增用户", "link" => "/admin/admins/create", "route" => "admin.admin.create", "icon" => "", "show" => 1, "sort" => 1],
        ["id" => 24, "parent_id" => 5, "name" => "编辑用户", "link" => "", "route" => "admin.admin.show", "icon" => "", "show" => 2, "sort" => 2],
        ["id" => 25, "parent_id" => 5, "name" => "删除用户", "link" => "", "route" => "admin.admin.delete", "icon" => "", "show" => 2, "sort" => 3],
        ["id" => 26, "parent_id" => 9, "name" => "广告列表", "link" => "/admin/ads", "route" => "admin.ad", "icon" => "", "show" => 1, "sort" => 0],
        ["id" => 27, "parent_id" => 9, "name" => "新增广告", "link" => "/admin/ads/create", "route" => "admin.ad.create", "icon" => "", "show" => 1, "sort" => 1],
        ["id" => 28, "parent_id" => 9, "name" => "编辑广告", "link" => "", "route" => "admin.ad.show", "icon" => "", "show" => 1, "sort" => 2],
        ["id" => 29, "parent_id" => 9, "name" => "删除广告", "link" => "", "route" => "admin.ad.delete", "icon" => "", "show" => 2, "sort" => 3],
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
