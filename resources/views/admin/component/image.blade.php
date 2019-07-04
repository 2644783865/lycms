<ul class="list-inline lyear-uploads-pic clearfix" id="upload-{{$name}}">
    @if(empty($value))
        <li class="li-upload-btn" id="tip-{{$name}}">
            <input type="hidden" name="{{$name}}" value="">
            <a class="pic-add upload-target" href="javascript:" title="点击上传"></a>
        </li>
    @else
        <li class="li-upload-pic" id="tip-{{$name}}">
            <figure>
                <img src="{{$value}}" alt="{{$value}}">
                <input type="hidden" name="{{$name}}" value="{{$value}}">
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
    @endif
</ul>
<script type="text/javascript">initImageUploader('{{$name}}');</script>