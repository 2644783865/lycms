<?php

namespace App\Http\Controllers\Admin;

use App\Models\Area;
use App\Models\Tree;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yeosz\LaravelCurd\ApiException;

class IndexController extends CommonController
{
    /**
     * 允许上传的文件类型
     *
     * @var array
     */
    protected $uploadType = [
        'image' => ['gif', 'jpg', 'jpeg', 'png', 'bmp'],
        'media' => ['swf', 'flv', 'mp3', 'mp4', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb', 'swf', 'flv'],
        'file' => ['doc', 'docx', 'xls', 'xlsx', 'csv', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2', 'pdf'],
    ];

    /**
     *
     * @return mixed
     */
    public function index()
    {
        return view('admin.index');
    }

    /**
     * 上传文件
     *
     * @param Request $request
     * @return JsonResponse
     * @throws ApiException
     */
    public function upload(Request $request)
    {
        $type = $request->input('file_type', '');
        $rename = $request->input('rename', false);
        $input = $request->input('input', 'upfile');
        if ($type == 'all') {
            $fileType = array_merge($this->uploadType['image'], $this->uploadType['media'], $this->uploadType['file']);
            $type = 'file';
        } elseif (!isset($this->uploadType[$type])) {
            throw new ApiException('文件类型不合法');
        } else {
            $fileType = $this->uploadType[$type];
        }
        $dir = $type . '/' . date('Ym');
        $url = '/uploads/' . $dir;
        $dir = public_path('uploads/' . $dir);

        return $this->xUploadFile($dir, $url, $input, $fileType, $rename);
    }


    /**
     * tree json
     *
     * @param $id
     * @return array
     */
    public function json($id)
    {
        if ($id == 'area') {
            $nodes = Area::where('status', 1)->get(['id', 'name', 'parent_id']);
        } else {
            $nodes = Tree::where('root_id', $id)->where('status', 1)->orderBy('sort', 'asc')->get(['id', 'parent_id', 'name']);
        }

        try {
            $nodes = $this->toTree($nodes);
            return $nodes;
        } catch (\Exception $e) {
            return [];
        }
    }
}
