@extends('admin.layout')

@section('main')
    <div class="card flex-1">
        <div class="card-body">
            <form class="form-horizontal box-form" action="{{$api ?? ''}}" method="post"
                  onsubmit="return ajaxSubmit(this);">
                <div class="form-group">
                    <label for="name" class="col-sm-2 col-lg-1 control-label">
                        <span class="form-required">*</span>姓名
                    </label>
                    <div class="col-sm-2">
                        <input name="name" type="text" class="form-control" id="name" value="{{$row->name ?? ''}}"
                               placeholder="姓名"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-2 col-lg-1 control-label">
                        <span class="form-required">*</span>邮箱
                    </label>
                    <div class="col-sm-2">
                        <input type="text" name="email" class="form-control" id="email" value="{{$row->email ?? ''}}"
                               placeholder="邮箱"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="avatar" class="col-sm-2 col-lg-1 control-label">
                        <span class="form-required">*</span>头像</label>
                    <div class="col-sm-4">
                        @component('admin.component.image',['value'=>$row->avatar ?? '', 'name'=>'avatar']) @endcomponent
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-2 col-lg-1 control-label">密码</label>
                    <div class="col-sm-2">
                        <input name="password" type="password" class="form-control" id="password" placeholder="密码"
                               value=""/>
                    </div>
                </div>
                @component('admin.component.form-submit') @endcomponent
            </form>
        </div>
    </div>
@endsection



