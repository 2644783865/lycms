@extends('admin.layout')

@section('main')

    <div class="card">
        <div class="card-body">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li @if(!$form) class="active" @endif>
                        <a href="{{route('admin.content')}}">全部</a>
                    </li>
                    @foreach($forms as $tab)
                        <li @if($form && $tab->id==$form->id) class="active" @endif>
                            <a href="{{route('admin.content')}}?form_id={{$tab->id}}">{{$tab->name}}</a>
                        </li>
                    @endforeach
                </ul>

                <form class="form-inline" name="list-form" id="list-form" action="" method="get">
                    <div class="input-group">
                        <input type="hidden" name="form_id" value="{{$form->id ?? ''}}">
                        <input type="text" class="form-control" value="" name="keyword" placeholder="请输入名称">
                        <span class="input-group-btn">
                            <button class="btn btn-danger" type="submit"><i class="fa fa-search"></i>查询</button>
                       </span>
                    </div>
                    <div class="toolbar-btn-action pull-right">
                        <a class="btn btn-success m-r-5"
                           href="{{route('admin.content.create')}}?form_id={{$form->id ?? ''}}">
                            <i class="mdi mdi-plus"></i>新增
                        </a>
                        <a class="btn btn-success m-r-5" id="btn-refresh" href="javascript:">
                            <i class="mdi mdi-refresh"></i>刷新
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @component('admin.component.list-table', ['page'=>$page])

        @slot('thead')
            <tr>
                <th style="min-width: 200px;">标题</th>
                <th>封面</th>
                @if(!$form)
                    <th>表单</th>
                @endif
                @foreach($fields as $field)
                    <th style="min-width: 80px;">{{$field->alias_name}}@if($field->unit)({{$field->unit}})@endif</th>
                @endforeach
                <th>状态</th>
                <th>置顶</th>
                <th style="min-width: 60px;">浏览量</th>
                <th style="min-width: 180px;">创建时间</th>
                <th>操作</th>
            </tr>
        @endslot

        @slot('tbody')
            @foreach($page as $item)
                <tr id="{{$item['id']}}">
                    <td>
                        @if(strlen($item['title'])>40)
                            {{mb_substr($item['title'],0,30) . '...'}}
                        @else
                            {{$item['title']}}
                        @endif
                    </td>
                    <td>
                        @if($item['cover'])
                            <img src="{{$item['cover']}}" class="list-img image-show"/>
                        @endif
                    </td>
                    @if(!$form)
                        <td>{{$item['form_name']}}</td>
                    @endif
                    @foreach($fields as $field)
                        @if($input[$field->code] == 'image' && !empty($item[$field->code]))
                            <td><img src="{{$item[$field->code]}}" class="list-img image-show"/></td>
                        @elseif(!empty($item[$field->code]) && strlen($item[$field->code])>40)
                            <td>
                                <span title="{{$item[$field->code]}}">{{mb_substr($item[$field->code],0,40) . '...'}}</span>
                            </td>
                        @else
                            <td>
                                <div>{{$item[$field->code] ?? ''}}</div>
                            </td>
                        @endif
                    @endforeach
                    <td>
                        @if($item->status ==1)
                            <a data-href="{{route('admin.content.status', ['id'=>$item->id])}}"
                               class="btn btn-xs btn-info btn-action" data-callback="updateStatus">启用</a>
                        @else
                            <a data-href="{{route('admin.content.status', ['id'=>$item->id])}}"
                               class="btn btn-xs btn-danger btn-action" data-callback="updateStatus">禁用</a>
                        @endif
                    </td>
                    <td>
                        @if($item->top > 0)
                            <a data-href="{{route('admin.content.top', ['id'=>$item->id])}}"
                               class="btn btn-xs btn-info btn-action" data-callback="updateStatus">是</a>
                        @else
                            <a data-href="{{route('admin.content.top', ['id'=>$item->id])}}"
                               class="btn btn-xs btn-danger btn-action" data-callback="updateStatus">否</a>
                        @endif
                    </td>
                    <td>{{$item['page_view']}}</td>
                    <td>{{$item['created_at']}}</td>
                    <td>
                        <div class="btn-group btn-group-xs-2">
                            <a href="{{route('admin.content.show', ['id'=>$item['id']])}}" class="btn btn-xs btn-info">
                                编辑
                            </a>
                            <a data-href="{{route('admin.content.delete', ['id'=>$item['id']])}}"
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
