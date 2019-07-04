@if($ad && !empty($ad->image))
<div class="ad whitebg imgscale">
    <ul>
        <a href="{{$ad->target??'javascript:'}}"><img src="{{$ad->image}}"></a>
    </ul>
</div>
@endif