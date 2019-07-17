@extends('admin.layout')

@section('main')
    <div class="card flex-1">
        <div class="card-body">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    @foreach($forms as $tab)
                        <li @if($tab->id==$form->id) class="active" @endif>
                            <a href="{{route('admin.content.create')}}?form_id={{$tab->id}}">
                                {{$tab->name}}
                            </a>
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content">

                    <div class="tab-pane active">
                        <form class="form-horizontal" action="" method="post" onsubmit="return ajaxSubmit(this);"
                              id="form-main">
                            <div class="form-group">
                                <div class="form-inline">
                                    <label for="title" class="col-sm-2 col-lg-1 control-label">
                                        <span class="form-required">*</span>标题
                                    </label>
                                    <div class="col-sm-5">
                                        <input name="form_id" type="hidden" value="{{$form->id}}">
                                        <input name="title" type="text" class="form-control w8" id="title"
                                               value="{{$row->title??''}}">
                                        <select class="form-control" name="status" id="status">
                                            @component('admin.component.options', ['options'=>App\Models\Content::STATUS,'selected'=>($row->status??0)]) @endcomponent
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="title" class="col-sm-2 col-lg-1 control-label">
                                    封面
                                </label>
                                <div class="col-sm-4">
                                    @component('admin.component.image',['name'=>'cover','value'=>($row->cover ?? '')]) @endcomponent
                                </div>
                            </div>
                            @foreach($form->form_groups as $group)
                                <div class="form-group">
                                    <label for="{{$group->code}}" class="col-sm-2 col-lg-1 control-label">
                                        @if($group->required==1)<span class="form-required">*</span>@endif
                                        {{$group->alias_name}}
                                    </label>
                                    @switch($group->input)
                                    @case('integer')
                                    @case('number')
                                    @case('string')
                                    @case('email')
                                    @case('mobile')
                                    @case('tel')
                                    @case('ip')
                                    @case('id_card')
                                    <div class="col-sm-3">
                                        @if($group->unit)
                                            <div class="input-group m-b-10">
                                                <input name="{{$group->code}}" type="text" class="form-control"
                                                       id="{{$group->code}}"
                                                       value="{{$row->attr_map[$group->code] ?? ''}}"/>
                                                <span class="input-group-addon">
                                                    {{$group->unit}}
                                                </span>
                                            </div>
                                        @else
                                            <input name="{{$group->code}}" type="text" class="form-control"
                                                   id="{{$group->code}}"
                                                   value="{{$row->attr_map[$group->code] ?? ''}}"/>
                                        @endif
                                        @if($group->placeholder)
                                            <div class="form-placeholder">{{$group->placeholder}}</div>
                                        @endif
                                    </div>
                                    @break
                                    @case('location')
                                    <div class="col-sm-3">
                                        <div class="input-group">
                                            <input name="{{$group->code}}" type="text" class="form-control"
                                                   id="{{$group->code}}"
                                                   value="{{$row->attr_map[$group->code] ?? ''}}"/>
                                            <span class="input-group-btn">
                                                    <button class="btn btn-success" type="button"
                                                            data-target="#{{$group->code}}"
                                                            onclick="openMap(this)"><i
                                                                class="mdi mdi-map-marker-radius"></i></button>
                                                </span>
                                        </div>
                                        @if($group->placeholder)
                                            <div class="form-placeholder">{{$group->placeholder}}</div>
                                        @endif
                                    </div>
                                    @break;
                                    @case('text')
                                    @case('json')
                                    <div class="col-sm-6 form-inline">
                                            <textarea name="{{$group->code}}" class="form-control" rows="4" cols="80"
                                                      id="{{$group->code}}">{{$row->attr_map[$group->code] ?? ''}}</textarea>
                                        @if($group->placeholder)
                                            <div class="form-placeholder">{{$group->placeholder}}</div>
                                        @endif
                                    </div>
                                    @break;
                                    @case('file')
                                    @case('media')
                                    <div class="col-sm-4 form-inline">
                                        @component('admin.component.file',['name'=>$group->code,'value'=>($row->attr_map[$group->code] ?? ''),'type'=>$group->input]) @endcomponent
                                        @if($group->placeholder)
                                            <div class="form-placeholder">{{$group->placeholder}}</div>
                                        @endif
                                    </div>
                                    @break;
                                    @case('html')
                                    <div class="col-sm-10">
                                        @component('admin.component.editor',['name'=>$group->code,'value'=>($row->attr_map[$group->code] ?? '')]) @endcomponent
                                        @if($group->placeholder)
                                            <div class="form-placeholder">{{$group->placeholder}}</div>
                                        @endif
                                    </div>
                                    @break;
                                    @case('markdown')
                                    <div class="col-sm-10">
                                        @component('admin.component.vditor',['name'=>$group->code,'value'=>($row->attr_map[$group->code] ?? '')]) @endcomponent
                                        @if($group->placeholder)
                                            <div class="form-placeholder">{{$group->placeholder}}</div>
                                        @endif
                                    </div>
                                    @break;
                                    @case('image')
                                    <div class="col-sm-4">
                                        @component('admin.component.image',['name'=>$group->code,'value'=>($row->attr_map[$group->code] ?? '')]) @endcomponent
                                        @if($group->placeholder)
                                            <div class="form-placeholder">{{$group->placeholder}}</div>
                                        @endif
                                    </div>
                                    @break;
                                    @case('images')
                                    <div class="col-sm-10">
                                        @component('admin.component.images',['name'=>$group->code,'value'=>($row->attr_map[$group->code] ?? '')]) @endcomponent
                                        @if($group->placeholder)
                                            <div class="form-placeholder">{{$group->placeholder}}</div>
                                        @endif
                                    </div>
                                    @break;
                                    @case('radio')
                                    <div class="col-sm-3">
                                        <select class="form-control" name="{{$group->code}}" id="{{$group->code}}">
                                            @component('admin.component.options', ['options'=>$group->value,'name'=>'name-value','selected'=>($row->attr_map[$group->code] ?? '')]) @endcomponent
                                        </select>
                                        @if($group->placeholder)
                                            <div class="form-placeholder">{{$group->placeholder}}</div>
                                        @endif
                                    </div>
                                    @break;
                                    @case('checkbox')
                                    <div class="col-sm-8">
                                        <input type="hidden" name="{{$group->code}}" value="">
                                        @foreach($group->value as $checkbox)
                                            <label class="lyear-checkbox checkbox-inline checkbox-primary">
                                                <input type="checkbox" name="{{$group->code}}[]"
                                                       @if(!empty($row->attr_map[$group->code]) && in_array($checkbox, $row->attr_map[$group->code]))
                                                       checked="checked"
                                                       @endif
                                                       value="{!! $checkbox !!}"/>
                                                <span>{{$checkbox}}</span>
                                            </label>
                                        @endforeach
                                        @if($group->placeholder)
                                            <div class="form-placeholder">{{$group->placeholder}}</div>
                                        @endif
                                    </div>
                                    @break;
                                    @case('date')
                                    <div class="col-sm-3">
                                        <input name="{{$group->code}}" type="text" autocomplete="off"
                                               class="form-control js-datepicker" id="{{$group->code}}"
                                               value="{{$row->attr_map[$group->code] ?? ''}}"
                                               data-date-format="yyyy/mm/dd"/>
                                        @if($group->placeholder)
                                            <div class="form-placeholder">{{$group->placeholder}}</div>
                                        @endif
                                    </div>
                                    @break;
                                    @case('datetime')
                                    <div class="col-sm-3">
                                        <input name="{{$group->code}}" type="text" autocomplete="off"
                                               class="form-control js-datetimepicker" id="{{$group->code}}"
                                               value="{{$row->attr_map[$group->code] ?? ''}}"
                                               data-side-by-side="true" data-locale="zh-cn"
                                               data-format="YYYY-MM-DD HH:mm:ss"/>
                                        @if($group->placeholder)
                                            <div class="form-placeholder">{{$group->placeholder}}</div>
                                        @endif
                                    </div>
                                    @break;
                                    @case('tags')
                                    <div class="col-sm-6">
                                        <input name="{{$group->code}}" type="text" autocomplete="off"
                                               class="form-control js-tags-input" id="{{$group->code}}"
                                               value="{{$row->attr_map[$group->code] ?? ''}}"
                                               placeholder="添加{{$group->alias_name}}"
                                        />
                                        @if($group->placeholder)
                                            <div class="form-placeholder">{{$group->placeholder}}</div>
                                        @endif
                                    </div>
                                    @break;
                                    @case('attribute')
                                    <div class="col-sm-10">
                                        <input type="hidden" name="{{$group->code}}" value="">
                                        @if(!empty($row->attr_map[$group->code]))
                                            @foreach($row->attr_map[$group->code] as $key=>$item)
                                                <div class="div-group form-inline form-inline-group margin-bottom-5">
                                                    <input name="{{$group->code}}[]" value="{{$key}}"
                                                           class="form-control" placeholder="属性名称"
                                                           style="width:150px">
                                                    <input name="{{$group->code}}_attributes[]" type="text"
                                                           class="form-control" placeholder="属性值" value="{{$item}}">
                                                    <button class="btn" onclick="deleteRow(this)">删除</button>
                                                </div>
                                            @endforeach
                                        @endif
                                        <div class="margin-top-5 div-button">
                                            <button type="button" class="btn btn-sm btn-success"
                                                    id="tip-{{$group->code}}"
                                                    onclick="addAttribute(this, '{{$group->code}}')">添加
                                            </button>
                                        </div>
                                    </div>
                                    @break;
                                    @case('specification')
                                    <div class="col-sm-10 div-parent">
                                        <input type="hidden" name="{{$group->code}}" value="">
                                        @if(!empty($row->attr_map[$group->code]))
                                            @foreach($row->attr_map[$group->code] as $key=>$item)
                                                <div class="div-group row margin-bottom-5 margin-left-0">
                                                    <div class="col-md-2 pull-left input-group">
                                                        <input name="{{$group->code}}[]" value="{{$key}}"
                                                               class="form-control" placeholder="规格名称"/>
                                                    </div>
                                                    <div class="col-md-5 pull-left">
                                                        <input name="{{$group->code}}_specifications[]" type="text"
                                                               class="form-control js-specs-input" value="{{$item}}"
                                                               placeholder="添加规格值"/>
                                                    </div>
                                                    <div class="pull-left">
                                                        <button type="button" class="btn" onclick="deleteRow(this)">
                                                            删除
                                                        </button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                        <div class="margin-top-5  div-button">
                                            <button type="button" class="btn btn-sm btn-success"
                                                    id="tip-{{$group->code}}"
                                                    onclick="addSpec(this,'{{$group->code}}')">添加
                                            </button>
                                        </div>
                                    </div>
                                    @break;
                                    @case('tree')
                                    <div class="form-inline">
                                        <div class="col-sm-10" id="tree-{{$group->code}}">
                                            @foreach($group->value->level as $key=>$item)
                                                <select class="form-control tree-{{$key}}" name="{{$group->code}}[]"
                                                        data-value="{{$row->attr_map[$group->code]['path'][$key]??0}}"></select>
                                            @endforeach
                                            @if($group->placeholder)
                                                <div class="form-placeholder">{{$group->placeholder}}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <script type="text/javascript">
                                        $(function () {
                                            $('#tree-{{$group->code}}').cxSelect({
                                                url: '/admin/trees/{{$group->value->id}}.json',
                                                selects: {!! $group->value->select !!},
                                                emptyStyle: 'none',
                                                jsonName: 'name',
                                                jsonValue: 'id',
                                                jsonSub: 'children'
                                            });
                                        });
                                    </script>
                                    @break;
                                    @case('area')
                                    <div class="form-inline">
                                        <div class="col-sm-10" id="area-{{$group->code}}">
                                            <select class="form-control area-0" name="{{$group->code}}[]"
                                                    data-value="{{$row->attr_map[$group->code]['path'][0]??0}}"></select>
                                            <select class="form-control area-1" name="{{$group->code}}[]"
                                                    data-value="{{$row->attr_map[$group->code]['path'][1]??0}}"></select>
                                            <select class="form-control area-2" name="{{$group->code}}[]"
                                                    data-value="{{$row->attr_map[$group->code]['path'][2]??0}}"></select>
                                            @if($group->placeholder)
                                                <div class="form-placeholder">{{$group->placeholder}}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <script type="text/javascript">
                                        $(function () {
                                            $('#area-{{$group->code}}').cxSelect({
                                                url: '/admin/trees/area.json',
                                                selects: ['area-0', 'area-1', 'area-2'],
                                                emptyStyle: 'none',
                                                jsonName: 'name',
                                                jsonValue: 'id',
                                                jsonSub: 'children'
                                            });
                                        });
                                    </script>
                                    @break
                                    @default

                                    @endswitch
                                </div>
                            @endforeach
                            @if(!empty($row))
                                <div class="form-group">
                                    <div class="form-inline">
                                        <label for="title" class="col-sm-2 col-lg-1 control-label">发布时间</label>
                                        <div class="col-sm-3">
                                            <input name="created_at" type="text" autocomplete="off"
                                                   class="form-control js-datetimepicker" id="created_at"
                                                   value="{{$row->created_at ?? ''}}"
                                                   data-side-by-side="true" data-locale="zh-cn"
                                                   data-format="YYYY-MM-DD HH:mm:ss"/>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @component('admin.component.form-submit', ['cancel'=>route('admin.content', ['form_id'=>$form->id])]) @endcomponent
                        </form>
                    </div>
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
    </div>
    <script type="text/javascript">
        function addSpec(obj, name) {
            var objHtml = '<div class="div-group row margin-bottom-5 margin-left-0">';
            objHtml += '<div class="input-group margin-bottom-5 col-md-2 pull-left"><input name="' + name + '[]" value="" class="form-control" placeholder="规格名称"/></div>';
            objHtml += '<div class="col-md-5 pull-left"><input name="' + name + '_specifications[]" type="text" class="form-control js-specs-input" value=""/></div>';
            objHtml += '<div class="pull-left"><button type="button" class="btn" onclick="deleteRow(this)">删除</button></div></div>';
            $(obj).parents('.div-button').before(objHtml);
            $("#form-main").find(".js-specs-input").tagsInput({
                height: "38px",
                width: "100%",
                defaultText: "添加规格值",
                removeWithBackspace: true,
                delimiter: [","]
            });
        }
        function addAttribute(obj, name) {
            var objHtml = '<div class="div-group form-inline form-inline-group margin-bottom-5">';
            objHtml += '<input name="' + name + '[]" value="" class="form-control" placeholder="属性名称" style="width:150px">';
            objHtml += ' <input name="' + name + '_attributes[]" type="text" class="form-control" placeholder="属性值" value="">';
            objHtml += ' <button class="btn" onclick="deleteRow(this)">删除</button></div>';
            $(obj).parents('.div-button').before(objHtml);
        }
        function deleteRow(obj) {
            $(obj).parents(".div-group").remove();
        }
        $(function () {
            $("#form-main").find(".js-specs-input").tagsInput({
                height: "38px",
                width: "100%",
                defaultText: "添加规格值",
                removeWithBackspace: true,
                delimiter: [","]
            });
        });
    </script>
@endsection