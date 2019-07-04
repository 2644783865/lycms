@extends('admin.layout')

@section('main')
    <div class="card flex-1">
        <div class="card-body">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    @foreach($configs as $config)
                        <li @if($loop->first) class="active" @endif >
                            <a href="#{{$config['code']}}" data-toggle="tab">{{$config['name']}}</a>
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content">
                    @foreach($configs as $config)
                        <div class="tab-pane @if($loop->first) active @endif" id="{{$config['code']}}">
                            <form class="form-horizontal" action="" method="post" onsubmit="return ajaxSubmit(this);">
                                <input type="hidden" name="_config_code" value="{{$config['code']}}">
                                @foreach($config['column'] as $item)
                                    <div class="form-group">
                                        <label for="from_name" class="col-sm-2 col-lg-1 control-label">
                                            @if(!empty($item['rules']) && stripos($item['rules'], 'equired'))
                                                <span class="form-required">*</span>
                                            @endif
                                            {{$item['name']}}
                                        </label>
                                        <div class="col-sm-4">
                                            <input name="{{$item['column']}}" type="text"
                                                   class="form-control" id="{{$config['code']}}-{{$item['column']}}"
                                                   value="{{$item['value'] ?? ''}}">
                                            @if(!empty($item['placeholder']))
                                                <div class="form-placeholder">{{$item['placeholder']}}</div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                                @component('admin.component.form-submit', ['cancel'=>0]) @endcomponent
                            </form>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection
