@extends('admin.layout')

@section('main')
    @component('admin.component.list-form')
    @slot('form')
    <div class="form-group">
        <div class="input-group">
            <input type="text" class="form-control" value="{{$_GET['keyword']??''}}" name="keyword" placeholder="请输入名称">
        <span class="input-group-btn">
            <button class="btn btn-danger" type="submit"><i class="fa fa-search"></i>查询</button>
        </span>
        </div>
    </div>
    @endslot

    @slot('button')
    <a class="btn btn-success m-r-5" href="{{route('admin.admin.create')}}"><i class="mdi mdi-plus"></i>新增</a>
    <a class="btn btn-success m-r-5" id="btn-refresh" href="javascript:"><i class="mdi mdi-refresh"></i>刷新</a>
    @endslot
    @endcomponent

    @component('admin.component.list-table', ['page'=>$page])
    @slot('thead')
    <tr>
        <th>头像</th>
        <th>姓名</th>
        <th>邮箱</th>
        <th>创建时间</th>
        <th>操作</th>
    </tr>
    @endslot
    @slot('tbody')
    @foreach($page as $item)
        <tr id="{{$item['id']}}">
            <td>
                @if($item->avatar) <img src="{{$item->avatar}}" class="list-img image-show"/>@endif
            </td>
            <td>
                <a href="javascript:" class="editable" data-type="text" data-pk="{{$item['id']}}"
                   data-url="{{route('admin.admin.show', ['id'=>$item['id']])}}" data-name="name">
                    {{$item['name']}}
                </a>
            </td>
            <td>{{$item['email']}}</td>
            <td>{{$item['created_at']}}</td>
            <td>
                <div class="btn-group btn-group-xs-2">
                    <a href="{{route('admin.admin.show', ['id'=>$item['id']])}}" class="btn btn-xs btn-info">
                        编辑
                    </a>
                    <a data-href="{{route('admin.admin.delete', ['id'=>$item['id']])}}"
                       class="btn btn-xs btn-info btn-delete">
                        删除
                    </a>
                </div>
            </td>
        </tr>
    @endforeach
    @endslot

    @endcomponent
@endsection
