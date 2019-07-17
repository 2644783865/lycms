<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Tree;
use App\Services\CompanyService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yeosz\LaravelCurd\Traits\CurdTrait;

class CompanyController extends Controller
{
    use CurdTrait;

    /**
     * @var CompanyService $service
     */
    protected $service;

    public function __construct(CompanyService $service)
    {
        $this->service = $service;
        $this->xView('service', $service, true);
    }

    /**
     * 首页
     *
     * @return View
     */
    public function index()
    {
        $news = $this->service->getTopContent('news', 9);
        $cases = $this->service->getTopContent('case', 9);
        return $this->xView('news', $news)
            ->xView('cases', $cases)
            ->xView('company.index');
    }

    /**
     * 资讯
     *
     * @param Request $request
     * @return View
     * @throws \Exception
     */
    public function news(Request $request)
    {
        $categoryId = $request->input('cid', 0);
        if ($categoryId) {
            $ids = $this->service->getIdsByCategory($categoryId);
            $pager = $this->service->whereIn('id', $ids)->orderBy('created_at', 'desc')->paginate(12);
        } else {
            $pager = $this->service->orderBy('created_at', 'desc')->paginate(12);
        }
        return $this->xView('pager', $pager)->xView('company.news');
    }

    /**
     * 资讯详情
     *
     * @param $id
     * @return View
     * @throws \Exception
     */
    public function showNews($id)
    {
        $detail = Content::find($id);
        $detail->setAttribute('attr_map', $detail->attr_map);
        return $this->xView('detail', $detail)->xView('company.news-show');
    }

    /**
     * 案例
     *
     * @param Request $request
     * @return View
     * @throws \Exception
     */
    public function case(Request $request)
    {
        $categoryId = $request->input('cid', 0);
        if ($categoryId) {
            $ids = $this->service->getIdsByCategory($categoryId);
            $pager = $this->service->case->whereIn('id', $ids)->orderBy('created_at', 'desc')->paginate(12);
        } else {
            $pager = $this->service->case->orderBy('created_at', 'desc')->paginate(3);
        }
        return $this->xView('pager', $pager)->xView('company.case');
    }

    /**
     * 案例详情
     *
     * @param $id
     * @return View
     * @throws \Exception
     */
    public function showCase($id)
    {
        $detail = Content::find($id);
        $attr = $detail->attr_map;
        if ($attr['link']) {
            return redirect($attr['link']);
        }
        $detail->setAttribute('attr_map', $attr);
        return $this->xView('company.case-show');
    }

    /**
     * 联系我们
     *
     * @return View
     */
    public function contact()
    {
        return $this->xView('company.contact');
    }

    /**
     * 关于我们
     *
     * @return View
     */
    public function about()
    {
        return $this->xView('company.about');
    }

    /**
     * 服务
     *
     * @return View
     */
    public function service()
    {
        return $this->xView('company.service');
    }

    /**
     * 流程
     *
     * @return View
     */
    public function process()
    {
        return $this->xView('company.process');
    }
}
