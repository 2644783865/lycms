<textarea id="textarea_{{$name}}" style="display:none">{!! $value !!}</textarea>
<div id="vditor_{{$name}}"></div>
<script type="text/javascript">
    var vditor_{{$name}} = new Vditor('vditor_{{$name}}', {
        cache: false,
        counter: 0,
        height: 300,
        width: '100%',
        editorName: '{{$name}}',
        tab: '  ',
        toolbar: ['headings', 'bold', 'italic', 'strike', '|', 'undo', 'redo', '|', 'line', 'quote', 'list', 'ordered-list', '|', 'code', 'inline-code', 'link', 'table', '|', 'upload', '|', 'preview', 'fullscreen', 'br'],
        upload: {
            accept: 'image/*',
            handler (file) {
                var fd = new FormData();
                fd.append("file_type", "image");
                fd.append("upfile", file[0]);
                $.ajax({
                    url: '/admin/upload',
                    type: 'post',
                    processData: false,
                    contentType: false,
                    data: fd,
                    success: function (data) {
                        if (data.code == 200) {
                            var url = '![image](' + data.data + ')';
                            vditor_{{$name}}.insertValue(url);
                        }
                        else {
                            showMsg('danger', '上传失败', data.message)
                        }
                    }
                })
            }
        }
    });
    vditor_{{$name}}.setValue($('#textarea_{{$name}}').val());
</script>