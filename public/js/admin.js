function setCookie(key, value, t) {
    var oDate = new Date();
    oDate.setDate(oDate.getDate() + t);
    document.cookie = key + "=" + value + "; expires=" + oDate.toDateString() + "; path=/";
}

function getCookie(key) {
    var arr1 = document.cookie.split("; ");
    for (var i = 0; i < arr1.length; i++) {
        var arr2 = arr1[i].split("=");
        if (arr2[0] == key) {
            return decodeURI(arr2[1]);
        }
    }
}

function removeCookie(key) {
    setCookie(key, "", -1);//把cookie设置为过期
}

function showMsg(type, title, content, delay) {
    var icon = {"success": "fa-check", "info": "fa-info", "warning": "fa-exclamation", "danger": "fa-ban"};
    $('#alert-msg').removeClass('alert-success alert-info alert-warning alert-danger').addClass('alert-' + type);
    $('#alert-msg i').removeClass('fa-check fa-ban fa-envelope-o fa-exclamation').addClass(icon[type]);
    $('#alert-msg .msg-title').html(title);
    $('#alert-msg .msg-content').html(content);
    $('#alert-msg').fadeIn();
    delay = delay ? delay : 2000;
    $('#alert-msg').delay(delay).fadeOut();
}

function showAlert(content, title) {
    $.confirm({
        title: title ? title : '出错啦',
        content: content,
        type: 'red',
        typeAnimated: true,
        buttons: {
            close: {
                text: '确定'
            }
        }
    });
}
function ajaxSubmit(obj) {
    var submitBtn = $(obj).find('.btn-submit');
    submitBtn.text('请稍候..').attr('disabled', 'disabled');
    $(obj).ajaxSubmit(function (data) {
        if (data.code == 200) {
            showMsg('success', '操作成功', data.message);
        } else {
            showResponseError(obj, data)
        }
        submitBtn.text('保 存').attr('disabled', false);
    });
    return false;
}

function showResponseError(obj, response) {
    if (response.code == 4003) {
        var data = response.data;
        var error = [];
        var input;
        for (i in data) {
            if ($(obj).find("#tip-" + i).length) {
                input = $(obj).find("#tip-" + i).eq(0);
            } else if ($('#' + i + '_tagsinput').length) {
                input = $('#' + i + '_tagsinput');
            } else if ($('#' + i).length) {
                input = $('#' + i);
            } else if ($(obj).find("input[type=text][name='" + i + "']").length) {
                input = $(obj).find("input[type=text][name='" + i + "']").eq(0);
            } else if ($(obj).find("input[type=password][name='" + i + "']").length) {
                input = $(obj).find("input[type=password][name='" + i + "']").eq(0);
            }
            else if ($("#vditor_" + i).length) {
                input = $("#vditor_" + i).eq(0);
            }
            else if ($(obj).find("textarea[name='" + i + "']").length) {
                input = $(obj).find("textarea[name='" + i + "']").eq(0);
                if ($(input).is(':hidden')) {
                    error.push(data[i]);
                    continue;
                }
            }
            else {
                error.push(data[i]);
                continue;
            }
            if (data[i]) {
                $(input).tooltip({title: data[i], placement: "top"}).tooltip('show').focus(function () {
                    $(this).tooltip('destroy');
                }).hover(function () {
                        $(this).tooltip('destroy');
                    }
                );
            }
        }
        if (error.length) {
            var errorMsg = error.join("<br />");
            errorMsg = errorMsg.replace("。。", '。');
            showMsg('danger', '数据校验失败，请检查!', errorMsg);
        } else {
            showMsg('danger', '操作失败', '数据校验失败，请修改!', 600);
        }
    }
    else {
        showMsg('danger', '操作失败', response.message);
    }
}

function ajaxExecute(obj) {
    var href = $(obj).data('href');
    $.post(href, {}, function (data) {
        if (data.code == 200) {
            showMsg('success', '操作成功', data.message);
            var func = $(obj).data('callback');
            if (typeof func != 'undefined') {
                doCallback(eval(func), obj);
            }
        }
        else {
            showMsg('danger', '操作失败', data.message);
        }
    });
}

function ajaxDelete(obj) {
    var href = $(obj).data('href');

    $.alert({
        title: '提示',
        content: '您确定要删除吗？',
        buttons: {
            confirm: {
                text: '确认',
                btnClass: 'btn-primary',
                action: function () {
                    $.ajax({
                        type: 'POST',
                        url: href,
                        dataType: "json",
                        data: {},
                        headers: {'X-HTTP-Method-Override': 'DELETE'},
                        success: function (data) {
                            if (data.code == 200) {
                                $(obj).parents('tr').eq(0).remove();
                            }
                            else {
                                showMsg('danger', '操作失败', data.message);
                            }
                        }
                    });
                }
            },
            cancel: {
                text: '取消'
            }
        }
    });
}

function updateStatus(obj) {
    var $texts = ['禁用', '启用'];
    $text = $(obj).text();
    if ($text == '上架' || $text == '下架') {
        $texts = ['下架', '上架'];
    } else if ($text == '是' || $text == '否') {
        $texts = ['否', '是'];
    }
    $(obj).hasClass('btn-info') ? $(obj).text($texts[0]) : $(obj).text($texts[1]);
    $(obj).toggleClass('btn-info btn-danger');
}

function doCallback(fn, obj) {
    fn.apply(this, [obj]);
}

function initFileUploader(name, fileType) {
    var targetObj = $('#' + name + '-button').eq(0);
    new Q.Uploader({
        url: '/admin/upload?file_type=' + fileType, // image,file,media
        target: targetObj[0],
        multiple: false, //选择文件时是否允许多选
        auto: true,
        allows: '',
        on: {
            add: function (task) {
                if (task.disabled) return showAlert("允许上传的文件格式为：" + this.ops.allows);
                this.list = [];
                this.map = {};
                this.index = 0;
                this.workerIdle = 1;
            },
            complete: function (task) {
                if (task.json.code != 200) {
                    showMsg('danger', '上传失败', task.json.message);
                    return false;
                }
                var fileUrl = task.json.data;
                $('#' + name).val(fileUrl);
            }
        }
    });
}

function initImageUploader(name) {
    var itemObj = $('#upload-' + name + ' li').eq(0);
    var targetObj = $('#upload-' + name + ' .upload-target').eq(0);
    $(itemObj).find('.upload-delete').unbind().click(function () {
        var htmlStr = '<li class="li-upload-btn" id="tip-' + name + '">';
        htmlStr += '<a class="pic-add upload-target" href="javascript:" title="点击上传">';
        htmlStr += '<input type="hidden" name="' + name + '" value="" />';
        htmlStr += '</a></li>';
        var element = $(htmlStr);
        $(itemObj).before(element).remove();
        initImageUploader(name);
    });
    $('.upload-show').unbind('click').click(function () {
        showImage(this);
    });
    new Q.Uploader({
        url: '/admin/upload?file_type=image',
        target: targetObj[0],
        multiple: false, //选择文件时是否允许多选
        auto: true,
        allows: ".jpg,.jpeg,.png,.gif,.bmp",
        on: {
            add: function (task) {
                if (task.disabled) return showAlert("允许上传的文件格式为：" + this.ops.allows);
                this.list = [];
                this.map = {};
                this.index = 0;
                this.workerIdle = 1;
            },
            complete: function (task) {
                if (task.json.code != 200) {
                    showMsg('danger', '上传失败', task.json.message);
                    return false;
                }
                var imageUrl = task.json.data;
                if ($(itemObj).hasClass('li-upload-pic')) {
                    $(itemObj).find('input').eq(0).val(imageUrl);
                    $(itemObj).find('img').eq(0).attr('src', imageUrl);
                }
                else {
                    var htmlStr = '<li class="li-upload-pic"><figure><img src="' + imageUrl + '">';
                    htmlStr += '<input type="hidden" name="' + name + '" value="' + imageUrl + '"><figcaption>';
                    htmlStr += '<a class="btn btn-round btn-square btn-primary upload-show" href="javascript:"><i class="mdi mdi-eye"></i></a>';
                    htmlStr += '<a class="btn btn-round btn-square upload-delete" href="javascript:"><i class="mdi mdi-delete"></i></a>';
                    htmlStr += '</figcaption></figure>';
                    htmlStr += '<div class="text-center"><a class="upload-target" href="javascript:">重新上传</a></div></li>';
                    var element = $(htmlStr);
                    $(itemObj).before(element);
                    $(itemObj).remove();
                    initImageUploader(name);
                }

            }
        }
    });
}

function initQUpload(itemObj) {
    var targetObj = $(itemObj).find('.upload-target').eq(0);
    $(itemObj).find('.upload-delete').click(function () {
        $(this).parents('.li-upload-pic').remove();
    });
    $('.upload-show').unbind('click').click(function () {
        showImage(this);
    });
    new Q.Uploader({
        url: '/admin/upload?file_type=image',
        target: targetObj[0],
        multiple: false,
        auto: true,
        allows: ".jpg,.jpeg,.png,.gif,.bmp",
        on: {
            add: function (task) {
                if (task.disabled) return showAlert("允许上传的文件格式为：" + this.ops.allows);
                this.list = [];
                this.map = {};
                this.index = 0;
                this.workerIdle = 1;
            },
            complete: function (task) {
                if (task.json.code != 200) {
                    showMsg('danger', '上传失败', task.json.message);
                    return false;
                }
                var imageUrl = task.json.data;
                var imageObj = $(itemObj).find('img');
                $(itemObj).find('input').eq(0).val(imageUrl);
                $(imageObj).eq(0).attr('src', imageUrl);
            }
        }
    });
};

function initImagesUploader(name) {
    var imageList = $('#upload-' + name).find('.li-upload-pic').each(function () {
        initQUpload(this);
    });
    var itemObj = $('#upload-' + name + ' .li-upload-btn');
    var targetObj = $(itemObj).find('.upload-target').eq(0);
    new Q.Uploader({
        url: '/admin/upload?file_type=image',
        target: targetObj[0],
        multiple: false,
        auto: true,
        allows: ".jpg,.jpeg,.png,.gif,.bmp",
        on: {
            add: function (task) {
                if (task.disabled) return showMsg('danger', '操作失败', "允许上传的文件格式为：" + this.ops.allows);
                this.list = [];
                this.map = {};
                this.index = 0;
                this.workerIdle = 1;
            },
            complete: function (task) {
                if (task.json.code != 200) {
                    showMsg('danger', '上传失败', task.json.message);
                    return false;
                }
                var imageUrl = task.json.data;
                var htmlStr = '<li class="li-upload-pic"><figure><img src="' + imageUrl + '">';
                htmlStr += '<input type="hidden" name="' + name + '[]" value="' + imageUrl + '"><figcaption>';
                htmlStr += '<a class="btn btn-round btn-square btn-primary upload-show" href="javascript:"><i class="mdi mdi-eye"></i></a>';
                htmlStr += '<a class="btn btn-round btn-square upload-delete" href="javascript:"><i class="mdi mdi-delete"></i></a>';
                htmlStr += '</figcaption></figure>';
                htmlStr += '<div class="text-center"><a class="upload-target" href="javascript:">重新上传</a></div></li>';
                var element = $(htmlStr);
                initQUpload(element);
                $(itemObj).before(element);
            }
        }
    });
}

function showImage(obj) {
    var getObjUrl = function (obj) {
        console.log($(obj)[0].tagName);
        var url = '';
        if ($(obj)[0].tagName == 'IMG') {
            url = $(obj).attr('src');
        }
        else if ($(obj).find('img').length) {
            url = $(obj).find('img').eq(0).attr('src');
        }
        else if ($(obj).parents('figure').length) {
            url = $(obj).parents('figure').eq(0).find('img').eq(0).attr('src');
        }
        else if ($(obj).parents('div').length) {
            url = $(obj).parents('a').eq(0).find('img').eq(0).attr('src');
        }
        return url;
    };
    var url = getObjUrl(obj);
    if (url != '') {
        var htmlStr = '<div style="text-align:center;"><img src="' + url + '" style="max-height:85vh !important;max-width:85% !important;"/></div>';
        $.dialog({
            title: '查看图片',
            content: htmlStr,
            columnClass: 'col-md-8 col-md-offset-2',
            draggable: false,
            alignMiddle: true,
            animationSpeed: 500
        });
    }
    return false;
}

function uploadFile() {
    $.confirm({
        title: '快捷上传',
        columnClass: 'col-md-6 col-md-offset-3',
        content: '' +
        '<div class="input-group col-sm-12" style="margin-top: 10px;">' +
        '<input type="text" class="form-control" name="upfile" id="upfile" value="" readonly/>' +
        '<span class="input-group-btn"><button class="btn btn-success" type="button"  id="upfile-button">上传</button></span></div>',
        buttons: {
            copy: {
                text: '复制',
                btnClass: 'btn-danger btn-upload-copy',
                action: function () {
                    $('.btn-upload-copy').attr('data-clipboard-target', '#upfile');
                    new ClipboardJS('.btn-upload-copy');
                    return true;
                }
            },
            cancel: {text: '取消'}
        }
    });
    setTimeout(function () {
        initFileUploader('upfile', 'all');
    }, 600);
}
// http://api.map.baidu.com/lbsapi/creatmap/
function openMap(obj) {
    obj = $($(obj).data('target'));
    var lnglat = $(obj).val();
    var map, point, marker, lng, lat;
    if (lnglat) {
        lng = lnglat.split(',')[0];
        lat = lnglat.split(',')[1];
    } else {
        lng = 116.46;
        lat = 39.92;
    }
    $.confirm({
        title: '地图定位',
        columnClass: 'col-md-10 col-md-offset-1',
        content: '<div id="baidu-map" style="width:100%;height:400px;"></div>',
        buttons: {
            done: {
                text: '确定',
                btnClass: 'btn-danger btn-upload-copy',
                action: function () {
                    lnglat = lng + ',' + lat;
                    $(obj).val(lnglat);
                    return true;
                }
            },
            cancel: {text: '取消'}
        }
    });
    setTimeout(function () {
        map = new BMap.Map("baidu-map", {minZoom: 5, maxZoom: 18});
        point = new BMap.Point(lng, lat);
        map.centerAndZoom(point, 14);
        map.enableScrollWheelZoom();
        // 拖动marker
        marker = new BMap.Marker(point);
        map.addOverlay(marker);
        marker.enableDragging();
        marker.addEventListener("dragend", function (e) {
            lng = e.point.lng;
            lat = e.point.lat;
        });
    }, 600);
}