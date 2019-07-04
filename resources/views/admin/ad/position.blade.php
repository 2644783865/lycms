@extends('admin.layout')

@section('main')
    @component('admin.component.list-form')
    @slot('form')
    <div class="input-group">
        <input type="text" name="name" id="name" class="form-control" placeholder="名称" value="">
        <span class="input-group-btn">
            <button class="btn btn-danger" type="submit"><i class="fa fa-plus"></i> 新增</button>
        </span>
    </div>
    @endslot

    @slot('button')
    <a class="btn btn-success m-r-5" id="btn-refresh" href="javascript:"><i class="mdi mdi-refresh"></i>刷新</a>
    @endslot
    @endcomponent

    @component('admin.component.list-table')

    @slot('thead')
    <tr>
        <th width="50px">ID</th>
        <th width="250px">名称</th>
        <th>状态</th>
        <th>备注</th>
        <th>管理</th>
    </tr>
    @endslot

    @slot('tbody')
    @foreach($page as $item)
        <tr id="{{$item['id']}}">
            <td>{{$item['id']}}</td>
            <td>
                <a href="javascript:" class="editable" data-type="text" data-pk="{{$item['id']}}"
                   data-url="{{route('admin.ad-position.update', ['id'=>$item['id']])}}"
                   data-name="name">{{$item['name']}}</a>
            </td>
            <td>
                @if($item->status ==2)
                    <a data-href="{{route('admin.ad-position.status', ['id'=>$item->id])}}"
                       class="btn btn-xs btn-danger btn-action" data-callback="updateStatus">禁用</a>
                @else
                    <a data-href="{{route('admin.ad-position.status', ['id'=>$item->id])}}"
                       class="btn btn-xs btn-info btn-action" data-callback="updateStatus">启用</a>
                @endif
            </td>
            <td>
                <a href="javascript:" class="editable" data-type="textarea" data-pk="{{$item['id']}}"
                   data-url="{{route('admin.ad-position.update', ['id'=>$item['id']])}}"
                   data-name="remark">{{$item['remark']}}</a>
            </td>
            <td>
                <div class="btn-group">
                    <a data-href="{{route('admin.ad-position.delete', ['id'=>$item['id']])}}"
                       class="btn btn-xs btn-info btn-delete"><i class="fa fa-remove"></i> 删除</a>
                </div>
            </td>
        </tr>
    @endforeach
    @endslot

    @endcomponent
@endsection
