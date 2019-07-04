@if(isset($name) && isset($value))
    @foreach($options as $option)
        <option value="{!! $option[$value] !!}"
                @if(isset($selected) && $selected==$option[$value]) selected="selected" @endif>
            {{$option[$name]}}
        </option>
    @endforeach
@elseif(!empty($name) && $name=='name-value' && empty($value))
    @foreach($options as $item)
        <option value="{!! $item !!}" @if(isset($selected) && $selected==$item) selected="selected" @endif>
            {{$item}}
        </option>
    @endforeach
@elseif(!is_array(current($options)))
    @foreach($options as $value=>$name)
        <option value="{!! $value !!}" @if(isset($selected) && $selected==$value) selected="selected" @endif>
            {{$name}}
        </option>
    @endforeach
@else
    @foreach($options as $option)
        <option value="{!! $option['id']??$option['value'] !!}"
                @if(isset($selected) && $selected==($option['id']??$option['value'])) selected="selected" @endif>
            {{$option['name']}}
        </option>
    @endforeach
@endif