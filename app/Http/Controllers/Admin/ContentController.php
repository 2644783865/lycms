<?php

namespace App\Http\Controllers\Admin;

use App\Models\Attribute;
use App\Models\Content;
use App\Http\Requests\Admin\ContentRequest;
use App\Models\ContentAttribute;
use App\Models\Form;
use App\Models\FormAttribute;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Yeosz\LaravelCurd\ApiException;
use DB;

class ContentController extends CommonController
{
    /**
     * 模型
     *
     * @var string
     */
    protected $model = Content::class;

    /**
     * 模板
     *
     * @var array
     */
    protected $view = [
        'create' => 'admin.content.form',
        'edit' => 'admin.content.form',
    ];

    /**
     * 首页
     *
     * @param Request $request
     * @return $this|\Illuminate\Contracts\View\Factory|View
     */
    public function index(Request $request)
    {
        $formId = $request->input('form_id', 0);
        $keyword = $request->input('keyword', '');
        $pageSize = $request->input('page_size', self::PAGE_SIZE);

        $forms = Form::get();

        $form = $formId ? Form::find($formId) : null;

        $select = ['contents.*', 'forms.name as form_name'];
        $list = Content::leftJoin('forms', 'forms.id', '=', 'contents.form_id')
            ->when($formId, function (Builder $query) use ($formId) {
                $query->where('form_id', $formId);
            })->when($keyword, function (Builder $query) use ($keyword) {
                $query->where('title', 'like', "%$keyword%");
            })->orderBy('top', 'desc')
            ->orderBy('id', 'desc')
            ->paginate($pageSize, $select);

        if ($form) {
            $attrIds = FormAttribute::where('form_id', $formId)->where('show', 1)->orderBy('sort', 'asc')
                ->pluck('attribute_id')
                ->toArray();
            if ($attrIds) {
                $fields = Attribute::withTrashed()->whereIn('id', $attrIds)
                    ->where('status', 1)
                    ->orderBy(DB::raw('FIND_IN_SET(id,"' . implode(',', $attrIds) . '")'))
                    ->get();
                $input = $fields->mapWithKeys(function ($item) {
                    return [$item->code => $item->input];
                })->toArray();
                foreach ($list as $item) {
                    /** @var Content $item */
                    $itemAttr = $item->attr_map;
                    foreach ($fields as $field) {
                        $value = $itemAttr[$field->code] ?? null;
                        if (is_object($value)) {
                            $value = $value->name ?? ''; // tree
                        } elseif (is_array($value)) {
                            $value = implode(',', $value);
                        }
                        $item->setAttribute($field->code, $value);
                    }
                }
            }
        }

        $this->xView('forms', $forms)->xView('form', $form, false)
            ->xView('page', $list)->xView('fields', $fields ?? [])
            ->xView('input', $input ?? []);

        return $this->xView('admin.content.index');
    }

    /**
     * 新增页
     *
     * @param Request $request
     * @return View
     * @throws ApiException
     */
    public function create(Request $request)
    {
        $formId = $request->input('form_id', 0);

        $forms = Form::get();
        if ($forms->isEmpty()) {
            return redirect(route('admin.form'));
        }
        // 当前表单
        $form = $formId > 0 ? Form::find($formId) : null;
        if (!$form) {
            $form = $forms->first();
        }

        // 赋值
        $form->setAttribute('form_groups', $form->attr_details);
        $this->xView('forms', $forms)->xView('form', $form);

        return $this->xCreate();
    }

    /**
     * 新增的接口
     *
     * @param ContentRequest $request
     * @return JsonResponse
     * @throws ApiException
     */
    public function store(ContentRequest $request)
    {
        $formId = $request->input('form_id', 0);

        $form = Form::find($formId);

        if (!$form) {
            throw new ApiException('表单不存在', ApiException::ERROR_NOT_FOUND);
        }

        $contentId = 0;
        list($newContent, $newAttributes) = $this->getRequestContent($contentId, $request, $form);

        try {
            DB::beginTransaction();

            $content = Content::create($newContent);
            $contentId = $content->id;
            ContentAttribute::insert($newAttributes);

            DB::commit();
            return $this->responseData($contentId);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseError(ApiException::ERROR_UNKNOWN, $e->getMessage());
        }
    }

    /**
     * 详情
     *
     * @param $id
     * @return JsonResponse
     * @throws ApiException
     */
    public function show($id)
    {
        $content = Content::find($id);

        if (!$content) {
            throw new ApiException('内容不存在', ApiException::ERROR_NOT_FOUND);
        }

        $forms = Form::withTrashed()->where(function (Builder $query) use ($content) {
            $query->whereNull('deleted_at')->orWhere('id', $content->form_id);
        })->get();

        $form = Form::withTrashed()->find($content->form_id);
        $form->setAttribute('form_groups', $form->attr_details);
        $content->setAttribute('attributes', $content->attributes);
        $content->setAttribute('attr_map', $content->attr_map);

        return $this->xView('forms', $forms)->xView('form', $form)->xView('row', $content)->xView('admin.content.form');
    }

    /**
     * 更新的接口
     *
     * @param $id
     * @param ContentRequest $request
     * @return JsonResponse
     * @throws ApiException
     */
    public function update($id, ContentRequest $request)
    {
        $content = Content::find($id);
        if (!$content) {
            throw new ApiException('内容不存在', ApiException::ERROR_NOT_FOUND);
        }
        $form = Form::withTrashed()->find($content->form_id);
        if (!$form || $form->deleted_at) {
            throw new ApiException('表单不存在', ApiException::ERROR_NOT_FOUND);
        }

        $contentId = $content->id;
        list($newContent, $newAttributes) = $this->getRequestContent($contentId, $request, $form);
        if (!empty($newContent['form_id'])) {
            unset($newContent['form_id']);
        }
        $attributeIds = array_column($newAttributes, 'attribute_id');

        try {
            DB::beginTransaction();

            ContentAttribute::where('content_id', $content->id)->whereIn('attribute_id', $attributeIds)->delete();
            $content->update($newContent);
            ContentAttribute::insert($newAttributes);

            DB::commit();
            return $this->responseData($content->id);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseError(ApiException::ERROR_UNKNOWN, $e->getMessage());
        }
    }

    /**
     * 更新状态的接口
     *
     * @param $id
     * @return JsonResponse
     */
    public function updateStatus($id)
    {
        return $this->xToggleColumn($id, 'status', [1, 2]);
    }

    /**
     * 更新状态的接口
     *
     * @param $id
     * @return JsonResponse
     */
    public function updateTop($id)
    {
        $top = time();
        return $this->xToggleColumn($id, 'top', [0, $top]);
    }

    /**
     * 删除的接口
     *
     * @param $id
     * @return JsonResponse
     */
    public function delete($id)
    {
        return $this->xDelete($id);
    }

    /**
     * 提取内容
     *
     * @param $id
     * @param Request $request
     * @param Form $form
     * @return array
     */
    protected function getRequestContent(&$id, Request $request, Form $form)
    {
        $newContent = $request->only(['form_id', 'title', 'cover', 'status']);

        $attributes = Attribute::get(['id', 'code', 'input'])->keyBy('code');

        $newAttributes = [];
        foreach ($form->attributes as $formAttribute) {
            $code = $formAttribute->attribute_code;
            if ($request->has($code)) {
                $value = $request->input($code, '');
                if (in_array($attributes[$code]['input'], ['tree', 'area'])) {
                    $value = is_array($value) ? $value : [];
                    $value = array_filter($value, 'is_numeric');
                    $value = end($value);
                } elseif (in_array($attributes[$code]['input'], ['attribute', 'specification'])) {
                    $value = $this->getSpecificationInfo($request, $attributes[$code]['input'], $code);
                    $value = empty($value) ? '[]' : json_encode($value);
                } elseif (is_array($value)) {
                    $value = empty($value) ? '[]' : json_encode($value);
                }
                if (isset($attributes[$code])) {
                    $newAttributes[] = [
                        'content_id' => &$id,
                        'attribute_id' => $attributes[$code]['id'],
                        'attribute_value' => $value,
                    ];
                }
            }
        }

        return [$newContent, $newAttributes];
    }

    /**
     * 获取属性或规格
     *
     * @param $request
     * @param $input
     * @param $field
     * @return array
     */
    protected function getSpecificationInfo(Request $request, $input, $field)
    {
        $keys = $request->input($field);
        $input = $field . '_' . $input . 's';
        $values = $request->input($input);
        $result = (empty($keys) || empty($values)) ? [] : array_combine($keys, $values);
        foreach ($result as $key => $value) {
            if (empty($key) || empty($value)) {
                unset($result[$key]);
            }
        }
        return $result;
    }
}