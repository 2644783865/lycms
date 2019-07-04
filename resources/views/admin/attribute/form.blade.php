@extends('admin.layout')

@section('main')
    <script type="text/javascript" src="/js/vue.js"></script>
    <div class="card flex-1">
        <div class="card-body">
            <form class="form-horizontal box-form" action="" method="post" onsubmit="return ajaxSubmit(this);">
                <div class="form-group">
                    <label for="code" class="col-sm-2 col-lg-1 control-label">
                        <span class="form-required">*</span>编码
                    </label>
                    <div class="col-sm-2">
                        <input name="code" type="text" class="form-control" id="code" value="{{$row->code ?? ''}}"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-2 col-lg-1 control-label">
                        <span class="form-required">*</span>名称
                    </label>
                    <div class="col-sm-3">
                        <input name="name" type="text" class="form-control" id="name" value="{{$row->name ?? ''}}"
                               placeholder="名称"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="code" class="col-sm-2 col-lg-1 control-label">
                        <span class="form-required">*</span>别名
                    </label>
                    <div class="col-sm-3">
                        <input name="alias_name" type="text" class="form-control" id="alias_name"
                               value="{{$row->alias_name ?? ''}}"
                               placeholder="别名"/>
                        <div class="form-placeholder">表单中显示的名称</div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-inline">
                        <label for="input" class="col-sm-2 col-lg-1 control-label">
                            <span class="form-required">*</span>输入类型
                        </label>
                        <div class="col-sm-2">
                            <select class="form-control" name="input" id="input" v-model="input">
                                @component('admin.component.options', ['options'=>App\Models\Attribute::INPUT,'selected'=>($row->input??'')]) @endcomponent
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group" v-if="input=='tree'">
                    <div class="form-inline">
                        <label for="input" class="col-sm-2 col-lg-1 control-label">级联</label>
                        <div class="col-sm-2">
                            <select class="form-control" name="tree_id" id="tree_id">
                                <option value="0">请选择级联</option>
                                @component('admin.component.options', ['options'=>App\Models\Tree::rootOptions($row->tree_id??0),'selected'=>($row->tree_id??'')]) @endcomponent
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group" v-if="input=='radio'||input=='checkbox'">
                    <label for="value" class="col-sm-2 col-lg-1 control-label">备选内容</label>
                    <div class="col-sm-4 form-inline">
                        <textarea name="value" class="form-control" rows="4" cols="80"
                                  id="value">{{$row->value??''}}</textarea>
                        <div class="form-placeholder">备选值之间用符号“|”分隔</div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-inline">
                        <label for="status" class="col-sm-2 col-lg-1 control-label">
                            <span class="form-required">*</span>状态|单位
                        </label>
                        <div class="col-sm-6">

                            <select class="form-control" name="status" id="status">
                                @component('admin.component.options', ['options'=>App\Models\Attribute::STATUS,'selected'=>($row->status??0)]) @endcomponent
                            </select>
                            <input type="text" name="unit" class="form-control" id="unit" value="{{$row->unit ?? ''}}"
                                   placeholder="单位"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="placeholder" class="col-sm-2 col-lg-1 control-label">提示文字</label>
                    <div class="col-sm-6">
                        <input type="text" name="placeholder" class="form-control" id="placeholder"
                               value="{{$row->placeholder ?? ''}}"
                               placeholder="提示文字"/>
                    </div>
                </div>

                <div class="form-group">
                    <label for="remark" class="col-sm-2 col-lg-1 control-label">备注</label>
                    <div class="col-sm-4 form-inline">
                        <textarea name="remark" class="form-control" rows="4" cols="80"
                                  id="remark">{{$row->remark??''}}</textarea>
                    </div>
                </div>
                @component('admin.component.form-submit') @endcomponent
            </form>
        </div>
    </div>
    <script type="text/javascript">
        var app = new Vue({
            el: '#app',
            data: {
                input: "{{$row->input??''}}"
            }
        });
    </script>
@endsection



