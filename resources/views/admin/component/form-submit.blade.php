<div class="form-group">
    <div class="col-lg-offset-1 col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-danger btn-submit">保 存</button>
        @if(!isset($cancel))
            <button type="button" class="btn btn-default btn-cancel" onclick="window.location.href=document.referrer;">
                取 消
            </button>
        @elseif(!empty($cancel))
            <a class="btn btn-default btn-cancel" href="{{$cancel}}">
                取 消
            </a>
        @endif
    </div>
</div>