<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use App\Models\Menu;
use Illuminate\Http\Request;

class CheckAdminPermit
{
    /**
     * @var array 权限转换
     */
    const PERMITS = [
        'admin.index' => '',
        'admin.upload' => '',
        'admin.tree.json' => '',
        'admin.profile' => '',
        'admin.profile.update' => '',
        'admin.editor.upload' => '',
        'admin.editor.system' => '',
        'admin.menu.nodes' => '',
        'admin.tree.nodes' => '',
        'admin.form-attribute.unselected' => '',
        'admin.admin.store' => 'admin.admin.create',
        'admin.admin.update' => 'admin.admin.show',
        'admin.menu.store' => 'admin.menu',
        'admin.menu.update' => 'admin.menu',
        'admin.menu.delete' => 'admin.menu',
        'admin.ad-position.update' => 'admin.ad-position',
        'admin.ad-position.status' => 'admin.ad-position',
        'admin.ad-position.delete' => 'admin.ad-position',
        'admin.ad.store' => 'admin.ad.create',
        'admin.ad.update' => 'admin.ad.show',
        'admin.ad.status' => 'admin.ad.show',
        'admin.attribute.store' => 'admin.attribute.create',
        'admin.attribute.update' => 'admin.attribute.show',
        'admin.attribute.status' => 'admin.attribute.show',
        'admin.form.show' => 'admin.form',
        'admin.form.store' => 'admin.form',
        'admin.form.update' => 'admin.form',
        'admin.form.delete' => 'admin.form',
        'admin.form-attribute.store' => 'admin.form',
        'admin.form-attribute.update' => 'admin.form',
        'admin.form-attribute.delete' => 'admin.form',
        'admin.content.store' => 'admin.content.create',
        'admin.content.update' => 'admin.content.show',
        'admin.content.status' => 'admin.content.show',
        'admin.content.top' => 'admin.content.show',
        'admin.tree.root' => 'admin.tree',
        'admin.tree.store' => 'admin.tree',
        'admin.tree.show' => 'admin.tree',
        'admin.tree.update' => 'admin.tree',
        'admin.tree.delete' => 'admin.tree',
    ];

    public function handle(Request $request, \Closure $next)
    {
        $result = $this->checkPermit($request);
        if (!$result) {
            $data = [
                'code' => 4008,
                'message' => '权限不足',
                'link' => route('admin.index'),
            ];
            return $request->expectsJson() ? response()->json($data) : response()->view('admin.error', $data);
        }

        return $next($request);
    }

    /**
     * 检查权限
     *
     * @param $request
     * @return bool|int
     */
    public function checkPermit($request)
    {
        $admin = $request->user();
        $route = request()->route()->getName();
        $permits = self::PERMITS;
        $permit = isset($permits[$route]) ? $permits[$route] : $route;
        if ($admin->super == 1 || empty($permit)) {
            return 1;
        }
        $menu = Menu::where('route', $permit)->first();
        if ($menu && !in_array($menu->id, $admin->menu_permits)) {
            return false;
        }
        return 2;
    }
}