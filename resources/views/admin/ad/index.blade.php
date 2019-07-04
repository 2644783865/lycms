@extends('admin.layout')

@section('main')
    @component('admin.component.list-form')
        @slot('form')
            <div class="input-group">
                <select id="position_id" class="form-control" name="position_id">
                    <option value="0">全部广告位</option>
                    @foreach(App\Models\AdPosition::options() as $item)
                        <option value="{{$item->id}}"
                                @if(!empty($_GET['position_id']) && $_GET['position_id']==$item->id)selected="selected" @endif>{{$item->name}}</option>
                    @endforeach
                </select>
                <span class="input-group-btn">
            <button class="btn btn-danger" type="submit"><i class="fa fa-search"></i> 查询</button>
       </span>
            </div>
        @endslot

        @slot('button')
            <a class="btn btn-success m-r-5" href="{{route('admin.ad.create')}}"><i class="mdi mdi-plus"></i>新增</a>
            <a class="btn btn-success m-r-5" id="btn-refresh" href="javascript:"><i class="mdi mdi-refresh"></i>刷新</a>
        @endslot
    @endcomponent

    @component('admin.component.list-table', ['page'=>$page])
        @slot('thead')
            <tr>
                <th>广告位</th>
                <th>标题</th>
                <th>图片</th>
                <th>状态</th>
                <th>排序</th>
                <th>投放时间</th>
                <th>管理</th>
            </tr>
        @endslot

        @slot('tbody')
            @foreach($page as $item)
                <tr id="{{$item['id']}}">
                    <td>{{$item['ad_position_name']}}</td>
                    <td>{{$item['title']}}</td>
                    <td>
                        @if($item->image) <img src="{{$item->image}}" class="list-img image-show"/>@endif
                    </td>
                    <td>
                        @if($item->status ==1)
                            <a data-href="{{route('admin.ad.status', ['id'=>$item->id])}}"
                               class="btn btn-xs btn-info btn-action" data-callback="updateStatus">启用</a>
                        @else
                            <a data-href="{{route('admin.ad.status', ['id'=>$item->id])}}"
                               class="btn btn-xs btn-danger btn-action" data-callback="updateStatus">禁用</a>
                        @endif
                    </td>
                    <td>{{$item['sort']}}</td>
                    <td>{{$item['start_time']}} - {{$item['end_time']}}</td>
                    <td>
                        <div class="btn-group btn-group-xs-2">
                            <a href="{{route('admin.ad.show', ['id'=>$item['id']])}}" class="btn btn-xs btn-info"><i
                                        class="fa fa-edit"></i>编辑</a>
                            <a data-href="{{route('admin.ad.delete', ['id'=>$item['id']])}}"
                               class="btn btn-xs btn-info btn-delete"><i class="fa fa-remove"></i>删除</a>
                        </div>
                    </td>
                </tr>
            @endforeach
        @endslot

    @endcomponent
@endsection
