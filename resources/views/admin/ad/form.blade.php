@extends('admin.layout')

@section('main')
    <div class="card flex-1">
        <div class="card-body">
            <form class="form-horizontal box-form" action="" method="post" onsubmit="return ajaxSubmit(this);">
                <div class="form-group">
                    <label for="title" class="col-md-2 col-lg-1 control-label">
                        <span class="form-required">*</span>标题
                    </label>
                    <div class="col-sm-3">
                        <input name="title" type="text" class="form-control" id="title" placeholder="标题"
                               value="{{$row->title ?? ''}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="subtitle" class="col-sm-2 col-lg-1 control-label">
                        副标题
                    </label>
                    <div class="col-sm-3">
                        <input name="subtitle" type="text" class="form-control" id="subtitle" placeholder="副标题"
                               value="{{$row->subtitle ?? ''}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="category" class="col-sm-2 col-lg-1 control-label">
                        <span class="form-required">*</span>广告位
                    </label>
                    <div class="col-sm-8 form-inline">
                        <select id="position_id" class="form-control" name="position_id" onchange="showRemark(this)">
                            <option value="0">请选择广告位</option>
                            @foreach(App\Models\AdPosition::options() as $item)
                                <option value="{{$item->id}}" data-remark="{{$item->remark}}"
                                        @if($item->id == ($row->position_id??0)) selected="selected" @endif>
                                    {{$item->name}}
                                </option>
                            @endforeach
                        </select>
                        <input name="sort" type="text" class="form-control" id="sort"
                               placeholder="排序" title="排序"
                               value="{{$row->sort??''}}">
                        <div class="form-placeholder" id="position_placeholder">　</div>

                    </div>
                </div>
                <div class="form-group">
                    <label for="image" class="col-sm-2 col-lg-1 control-label">图片</label>
                    <div class="col-sm-10">
                        @component('admin.component.image',['value'=>$row->image??'', 'name'=>'image']) @endcomponent
                    </div>

                </div>
                <div class="form-group">
                    <div class="form-inline">
                        <label for="start_time" class="col-sm-2 col-lg-1 control-label">
                            <span class="form-required">*</span>投放时间
                        </label>
                        <div class="col-sm-8">
                            <input name="start_time" type="text" class="form-control js-datetimepicker" id="start_time"
                                   placeholder="开始时间" value="{{$row->start_time??''}}"
                                   data-side-by-side="true" data-locale="zh-cn" data-format="YYYY-MM-DD HH:mm:ss"/>

                            至 <input name="end_time" type="text" class="form-control js-datetimepicker" id="end_time"
                                     placeholder="结束时间" value="{{$row->end_time??''}}"
                                     data-side-by-side="true" data-locale="zh-cn" data-format="YYYY-MM-DD HH:mm:ss"/>
                            <select class="form-control" name="status" id="status">
                                @component('admin.component.options', ['options'=>App\Models\Ad::STATUS,'selected'=>($row->status??0)]) @endcomponent
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="target_type" class="col-sm-2 col-lg-1 control-label">
                        <span class="form-required">*</span>链接类型
                    </label>
                    <div class="col-sm-8 form-inline">
                        <select class="form-control" name="target_type" id="target_type">
                            @component('admin.component.options', ['options'=>App\Models\Ad::TARGET_TYPE,'selected'=>($row->target_type??0)]) @endcomponent
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="target" class="col-sm-2 col-lg-1 control-label">
                        <span class="form-required">*</span>链接内容
                    </label>
                    <div class="col-sm-4 form-inline">
                        <textarea name="target" class="form-control" rows="2" cols="100"
                                  id="target">{{$row->target??''}}</textarea>
                    </div>
                </div>
                @component('admin.component.form-submit') @endcomponent
            </form>
        </div>
    </div>
    <script type="text/javascript">
        function showRemark() {
            var remark = $('#position_id option:selected').data('remark');
            if (remark) {
                $('#position_placeholder').text(remark);
            }
            else {
                $('#position_placeholder').text('　');
            }
        }
        showRemark();
    </script>
@endsection
