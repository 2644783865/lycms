<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Menu;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Yeosz\LaravelCurd\Traits\ResponseTrait;

class BaseController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, ResponseTrait;

    /**
     * @var integer 页码
     */
    const PAGE_SIZE = 15;

    /**
     * @var Admin
     */
    protected $admin;

    /**
     * 当前登录用户
     *
     * @return Admin|null
     */
    protected function admin()
    {
        if ($this->admin) {
            return $this->admin;
        } else {
            return $this->admin = Auth::user();
        }
    }
}
