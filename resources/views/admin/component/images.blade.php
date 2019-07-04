<input type="hidden" name="{{$name}}" value="">
<ul class="list-inline clearfix lyear-uploads-pic" id="upload-{{$name}}">
    @if(!empty($value))
    @foreach($value as $image)
        <li class="li-upload-pic">
            <figure>
                <img src="{{$image}}" alt="{{$image}}">
                <input type="hidden" name="{{$name}}[]" value="{{$image}}">
                <figcaption>
                    <a class="btn btn-round btn-square btn-primary upload-show" href="javascript:">
                        <i class="mdi mdi-eye"></i>
                    </a>
                    <a class="btn btn-round btn-square upload-delete" href="javascript:">
                        <i class="mdi mdi-delete"></i>
                    </a>
                </figcaption>
            </figure>
            <div class="text-center"><a class="upload-target" href="javascript:">重新上传</a></div>
        </li>
    @endforeach
    @endif
    <li class="li-upload-btn" id="tip-{{$name}}">
        <a class="pic-add upload-target" href="javascript:" title="点击上传"></a>
    </li>
</ul>
<script type="text/javascript">initImagesUploader('{{$name}}');</script>