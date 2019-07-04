<div class="input-group col-sm-12">
    <input type="text" class="form-control" name="{{$name}}" id="{{$name}}" value="{{$value ?? ''}}" @if(empty($readonly)) readonly @endif/>
    <span class="input-group-btn">
        <button class="btn btn-success" type="button"  id="{{$name}}-button">上传</button>
    </span>
</div>
<script type="text/javascript">initFileUploader('{{$name}}', '{{$type??""}}');</script>