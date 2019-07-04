<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Yeosz\LaravelCurd\Traits\TreeTrait;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers, TreeTrait;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('admin.login');
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect(route('admin.login'));
    }

    /**
     * 重写 Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  mixed $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        $this->initMenus();
        return redirect(route('admin.index'));
    }

    /**
     * 初始化菜单
     */
    protected function initMenus()
    {
        if (!Session::get('menus')) {
            /** @var Menu $menus */
            $menus = Menu::query()->orderBy('parent_id', 'asc')->orderBy('sort', 'asc')->get();
            $menuDict = [];
            foreach ($menus as $menu) {
                $menuDict[$menu->id] = [$menu];
                if ($menu->controller && $menu->action) {
                    $menuDict[$menu->controller . '@' . $menu->action] = $menu->id;
                }
                $menuDict[$menu->id] = $menu->toArray();
            }
            $tree = $this->toTree($menus->toArray(), 'id', 'parent_id');
            Session::put('menus', ['tree' => $tree, 'dict' => $menuDict]);
        }
    }
}
