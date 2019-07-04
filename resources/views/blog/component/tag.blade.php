@if($tags)
<div class="whitebg cloud">
    <h2 class="htitle">标签云</h2>
    <ul>
        @foreach($tags as $item)
            <a href="{{route('blog.tag',[$item->title])}}" target="_blank">{{$item->title}}</a>
        @endforeach
    </ul>
</div>
@endif