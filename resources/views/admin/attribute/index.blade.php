@extends('admin.layout')

@section('main')
    @component('admin.component.list-form')
        @slot('form')
            <select id="input" class="form-control" name="input">
                <option value="0">全部</option>
                @component('admin.component.options', ['options'=>App\Models\Attribute::INPUT,'selected'=>($_GET['input']??'')]) @endcomponent
            </select>
            <div class="input-group">
                <input type="text" class="form-control" value="{{$_GET['keyword']??''}}" name="keyword">
                <span class="input-group-btn">
        <button class="btn btn-danger" type="submit"><i class="fa fa-search"></i>查询</button>
        </span>
            </div>
        @endslot

        @slot('button')
            <a class="btn btn-success m-r-5" href="{{route('admin.attribute.create')}}"><i
                        class="mdi mdi-plus"></i>新增</a>
            <a class="btn btn-success m-r-5" id="btn-refresh" href="javascript:"><i class="mdi mdi-refresh"></i>刷新</a>
        @endslot
    @endcomponent

    @component('admin.component.list-table', ['page'=>$page])
        @slot('thead')
            <tr>
                <th class="col-md-2">名称</th>
                <th class="col-md-2">别名</th>
                <th class="col-md-2">编码</th>
                <th class="col-md-2">表单类型</th>
                <th class="col-md-1">状态</th>
                <th class="col-md-3">操作</th>
            </tr>
        @endslot
        @slot('tbody')
            @foreach($page as $item)
                <tr id="{{$item->id}}">
                    <td>{{$item->name}}</td>
                    <td>{{$item->alias_name}}</td>
                    <td>{{$item->code}}</td>
                    <td>{{$item::INPUT[$item->input]}}</td>
                    <td>
                        @if($item->status ==1)
                            <a data-href="{{route('admin.attribute.status', ['id'=>$item->id])}}"
                               class="btn btn-xs btn-info btn-action" data-callback="updateStatus">启用</a>
                        @else
                            <a data-href="{{route('admin.attribute.status', ['id'=>$item->id])}}"
                               class="btn btn-xs btn-danger btn-action" data-callback="updateStatus">禁用</a>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group btn-group-xs-3">
                            <a href="{{route('admin.attribute.show', ['id'=>$item->id])}}" class="btn btn-xs btn-info">
                                编辑
                            </a>
                            <a data-href="{{route('admin.attribute.delete', ['id'=>$item->id])}}"
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
