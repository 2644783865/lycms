<textarea id="editor_{{$name}}" name="{{$name}}" style="width:98%;height:300px;">{!! $value !!}</textarea>
<script type="text/javascript">
    KindEditor.ready(function(K) {
        window.editor = K.create('#editor_{{$name}}',{
            filePostName : 'file',
            uploadJson : '{{route('admin.editor.upload')}}',
            fileManagerJson : '{{route('admin.editor.system')}}',
            allowFileManager : true,
            afterBlur: function () { this.sync(); }
        });
    });
</script>