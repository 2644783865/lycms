<?php

namespace App\Http\Controllers;

use App\Models\Tree;
use App\Services\BlogService;
use Illuminate\View\View;
use Yeosz\LaravelCurd\Traits\CurdTrait;
use Yeosz\LaravelCurd\Traits\TreeTrait;

class BlogController extends Controller
{
    use TreeTrait, CurdTrait;

    /**
     * @var BlogService $service
     */
    protected $service;

    public function __construct(BlogService $service)
    {
        $this->service = $service;
        $this->xView('categories', $this->getCategories(), true)->xView('service', $service, true);
    }

    /**
     * 首页
     *
     * @return View
     */
    public function index()
    {
        return $this->xView('blog.index');
    }

    /**
     * 分类列表
     *
     * @param $id
     * @return View
     */
    public function category($id)
    {
        $category = Tree::find($id);
        $articles = $this->service->filterByCategory($id)->orderBy('created_at', 'desc')->paginate(15);
        return $this->xView('category', $category)->xView('articles', $articles)->xView('blog.category');
    }

    /**
     * 标签列表
     *
     * @param $id
     * @return mixed
     */
    public function tag($id)
    {
        $articles = $this->service->filterByTag($id)->orderBy('created_at', 'desc')->paginate(15);
        return $this->xView('id', $id)->xView('articles', $articles)->xView('blog.tag');
    }

    /**
     * 归档
     *
     * @return View
     */
    public function archive()
    {
        $articles = $this->service->orderBy('created_at', 'desc')->paginate(25);
        return $this->xView('articles', $articles)->xView('blog.archive');
    }

    /**
     * 详情页
     *
     * @param $id
     * @return View
     */
    public function show($id)
    {
        $article = $this->service->getDetail($id);
        if (!$article) {
            return redirect(route('blog.index'));
        }
        return $this->xView('article', $article)->xView('blog.detail');
    }

    /**
     * 关于我
     *
     * @return View
     */
    public function about()
    {
        return $this->xView('blog.about');
    }

    /**
     *
     *
     * @return array
     */
    protected function getCategories()
    {
        $rootId = $this->service->getCategoryRootId();
        $nodes = Tree::whereRootId($rootId)->get();
        $tree = $this->toTree($nodes);
        return $tree;
    }
}
