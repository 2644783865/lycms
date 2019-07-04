@extends('admin.layout')

@section('main')
    <script type="text/javascript" src="/js/vue.js"></script>
    <div class="card flex-1 scroll-y" id="app" v-cloak>
        <div class="card-body clearfix">
            <div class="col-sm-5">
                <div class="panel panel-default">
                    <div class="panel-heading">表单</div>
                    <div class="panel-body">
                        <button class="btn btn-danger btn-xs pull-right" v-on:click="createForm">新增</button>
                    </div>
                    <table class="table table-condensed">
                        <thead>
                        <tr>
                            <th class="col-sm-4">名称</th>
                            <th class="col-sm-3">编码</th>
                            <th class="col-sm-5">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(form,index) in forms" :data-id="form.id" v-on:click="loadAttributes(form.id)">
                            <td>@{{form.name}}</td>
                            <td>@{{form.code}}</td>
                            <td>
                                <div class="btn-group btn-group-xs-2">
                                    <a :data-href="'/admin/forms/'+form.id"
                                       class="btn btn-xs btn-info"
                                       v-on:click="editForm(index,$event)">
                                        修改
                                    </a>
                                    <a :data-href="'/admin/forms/'+form.id"
                                       class="btn btn-xs btn-info"
                                       v-on:click="deleteItem(1,index,$event)">
                                        删除
                                    </a>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-sm-7">
                <div class="panel panel-default">
                    <div class="panel-heading">表单字段</div>
                    <div class="panel-body" v-if="currentForm.id">
                        <label>表单名称：<span>@{{currentForm.name}}</span></label>
                        <button class="btn btn-danger btn-xs pull-right" v-on:click="createAttributes()" :data-id="
                        currentForm.id">新增
                        </button>
                    </div>
                    <div class="panel-body" v-else>
                        <label>表单名称：</label><span class="form-required">请选择一个表单</span>
                    </div>
                    <table class="table table-condensed" v-if="currentForm.id">
                        <thead>
                        <tr>
                            <th class="col-sm-3">名称</th>
                            <th class="col-sm-2">编码</th>
                            <th class="col-sm-1">排序</th>
                            <th class="col-sm-1">必填</th>
                            <th class="col-sm-1">列表</th>
                            <th class="col-sm-4">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(attribute,index) in attributes"
                            :class="[attribute.attribute_status==2 ? 'danger' : '']"
                            :title="[attribute.attribute_status==2 ? '该字段已禁用' : '']">
                            <td>@{{attribute.attribute_name}}</td>
                            <td>@{{attribute.attribute_code}}</td>
                            <td>@{{attribute.sort}}</td>
                            <td>
                                <label class="lyear-checkbox checkbox-inline checkbox-primary">
                                    <input type="checkbox" value="1" v-model="attribute.required" true-value="1"
                                           false-value="2" onclick="return false;"/>
                                    <span></span>
                                </label>
                            </td>
                            <td>
                                <label class="lyear-checkbox checkbox-inline checkbox-primary">
                                    <input type="checkbox" value="1" v-model="attribute.show" true-value="1"
                                           false-value="2" onclick="return false;"/>
                                    <span></span>
                                </label>
                            </td>
                            <td>
                                <div class="btn-group btn-group-xs-2">
                                    <a :data-href="'/admin/form-attributes/'+attribute.id"
                                       class="btn btn-xs btn-info"
                                       v-on:click="editAttribute(index,$event)">
                                        修改
                                    </a>
                                    <a class="btn btn-xs btn-info"
                                       :data-href="'/admin/form-attributes/'+attribute.id"
                                       v-on:click="deleteItem(2,index,$event)">
                                        删除
                                    </a>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="col-sm-12" id="div-attrs" style="display:none;">
                <table class="table table-condensed">
                    <thead>
                    <tr>
                        <th>选择</th>
                        <th>输入类型</th>
                        <th>属性名称</th>
                        <th>属性别名</th>
                        <th>属性编码</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="attr in unselected">
                        <td>
                            <label class="lyear-checkbox checkbox-inline checkbox-primary">
                                <input type="checkbox" name="attr_ids" :value="attr.attribute_id">
                                <span></span>
                            </label>
                        </td>
                        <td>@{{attr.input_name}}</td>
                        <td>@{{attr.attribute_name}}</td>
                        <td>@{{attr.alias_name}}</td>
                        <td>@{{attr.attribute_code}}</td>
                    </tr>
                </table>
            </div>

        </div>
    </div>
    <script type="text/javascript">
        $.ajaxSettings.async = false;
        var api = [
            "{{route('admin.form')}}",
            "{{route('admin.form.store')}}",
            "{{route('admin.form-attribute.unselected')}}",
            "{{route('admin.form-attribute.store')}}"
        ];
        var app = new Vue({
            el: '#app',
            data: {
                currentForm: {id: 0, name: ''},
                forms: [],
                attributes: [],
                unselected: []
            },
            methods: {
                loadForms: function () {
                    if (this.forms.length) {
                        this.forms = [];
                    }
                    this.$nextTick(function () {
                        var forms = [];
                        $.get(api[0], function (result) {
                            forms = result.data;
                        });
                        this.forms = forms;
                    });
                },
                loadAttributes: function (formId) {
                    if (this.currentForm.id != 0) {
                        this.currentForm.id = 0;
                    }
                    this.$nextTick(function () {
                        var apiUrl = api[0] + '/' + formId;
                        var attr = [];
                        $.get(apiUrl, function (result) {
                            attr = result.data;
                        });
                        this.attributes = attr.attributes;
                        this.currentForm = attr;
                    });
                },
                deleteItem: function (type, index, event) {
                    event.stopPropagation();
                    var url = $(event.currentTarget).data('href');
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
                                        url: url,
                                        dataType: "json",
                                        data: {},
                                        headers: {'X-HTTP-Method-Override': 'DELETE'},
                                        success: function (data) {
                                            if (data.code != 200) {
                                                showMsg('danger', '操作失败', data.message);
                                            } else {
                                                if (type == 1) {
                                                    app.forms.splice(index, 1);
                                                } else {
                                                    app.attributes.splice(index, 1);
                                                }
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
                },
                createForm: function () {
                    $.confirm({
                        title: '新增表单',
                        columnClass: 'col-md-4 col-md-offset-4',
                        content: '' +
                        '<form class="form-horizontal col-md-12" action="{{route('admin.form.store')}}" style="margin-top:20px" id="form-form" method="post">' +
                        '<div class="form-group"><label class="control-label"><span class="form-required">*</span>名称</label><input type="text" class="form-control" name="name" required /></div>' +
                        '<div class="form-group"><label class="control-label"><span class="form-required">*</span>编码</label><input type="text" class="form-control" name="code" required /></div>' +
                        '</form>',
                        buttons: {
                            formSubmit: {
                                text: '保存',
                                btnClass: 'btn-danger',
                                action: function () {
                                    var submitResult = true;
                                    $('#form-form').ajaxSubmit({
                                        success: function (result) {
                                            if (result.code == 200) {
                                                app.loadForms();
                                            } else {
                                                showResponseError($('#form-form'), result);
                                                submitResult = false;
                                            }
                                        }
                                    });
                                    return submitResult;
                                }
                            },
                            cancel: {text: '取消'}
                        }
                    });
                },
                editForm: function (index, event) {
                    event.stopPropagation();
                    var item = this.forms[index];
                    var url = $(event.currentTarget).data('href');
                    $.confirm({
                        title: '修改表单',
                        columnClass: 'col-md-4 col-md-offset-4',
                        content: '' +
                        '<form class="form-horizontal col-md-12" action="' + url + '" style="margin-top:20px" id="form-form" method="post">' +
                        '<div class="form-group"><label class="control-label"><span class="form-required">*</span>名称</label><input type="text" class="form-control" name="name" value="' + item.name + '" required /></div>' +
                        '<div class="form-group"><label class="control-label"><span class="form-required">*</span>编码</label><input type="text" class="form-control" name="code" value="' + item.code + '" required /></div>' +
                        '</form>',
                        buttons: {
                            formSubmit: {
                                text: '保存',
                                btnClass: 'btn-danger',
                                action: function () {
                                    var submitResult = true;
                                    $('#form-form').ajaxSubmit({
                                        success: function (result) {
                                            if (result.code == 200) {
                                                app.loadForms();
                                            } else {
                                                showResponseError($('#form-form'), result);
                                                submitResult = false;
                                            }
                                        }
                                    });
                                    return submitResult;
                                }
                            },
                            cancel: {text: '取消'}
                        }
                    });
                },
                createAttributes: function () {
                    var formId = this.currentForm.id;
                    var url = api[2] + '?form_id=' + formId;
                    $.get(url, function (result) {
                        Vue.set(app, 'unselected', result.data);
                        app.$nextTick(function () {
                            var html = $('#div-attrs').html();
                            $.confirm({
                                title: '新增字段',
                                columnClass: 'col-md-6 col-md-offset-3',
                                content: html,
                                boxWidth: '40%',
                                buttons: {
                                    formSubmit: {
                                        text: '保存',
                                        btnClass: 'btn-danger',
                                        action: function () {
                                            var submitResult = true;
                                            var ids = [];
                                            var input = this.$content.find('input');
                                            $.each($(input), function () {
                                                if ($(this).is(':checked')) {
                                                    ids.push($(this).val());
                                                }
                                            });
                                            if (ids.length) {
                                                $.post(api[3], {
                                                    form_id: formId,
                                                    attribute_ids: ids
                                                }, function (result) {
                                                    if (result.code == 200) {
                                                        app.loadAttributes(formId);
                                                    } else {
                                                        showMsg('danger', '新增失败', result.message);
                                                        submitResult = false;
                                                    }
                                                })
                                            }
                                            return submitResult;
                                        }
                                    },
                                    cancel: {text: '取消'}
                                }
                            });
                        });
                    });
                },
                editAttribute: function (index, event) {
                    var item = this.attributes[index];
                    var url = $(event.currentTarget).data('href');
                    var selected = [
                        item.required == 1 ? 'selected="selected"' : '',
                        item.required == 2 ? 'selected="selected"' : '',
                        item.show == 1 ? 'selected="selected"' : '',
                        item.show == 2 ? 'selected="selected"' : ''
                    ];
                    var formId = this.currentForm.id;
                    $.confirm({
                        title: '修改表单字段',
                        columnClass: 'col-md-4 col-md-offset-4',
                        autoClose: false,
                        content: '' +
                        '<form class="form-horizontal col-md-12" action="' + url + '" style="margin-top:20px" id="form-attribute" method="post">' +
                        '<div class="form-group"><label class="control-label">名称</label><input type="text" class="form-control" name="name" value="' + item.attribute_name + '" readonly /></div>' +
                        '<div class="form-group"><label class="control-label">编码</label><input type="text" class="form-control" name="code" value="' + item.attribute_code + '" readonly /></div>' +
                        '<div class="form-group"><label class="control-label">排序</label><div class="form-inline">' +
                        '<input type="text" class="form-control" name="sort" value="' + item.sort + '" style="width:100px;" placeholder="排序" />&nbsp;' +
                        '<select class="form-control" name="required"><option value="1" ' + selected[0] + '>必填</option><option value="2" ' + selected[1] + '>非必填</option></select>&nbsp;' +
                        '<select class="form-control" name="show"><option value="1" ' + selected[2] + '>列表显示</option><option value="2" ' + selected[3] + '>列表不显示</option></select></div></div>' +
                        '</form>',
                        buttons: {
                            formSubmit: {
                                text: '保存',
                                btnClass: 'btn-danger',
                                action: function () {
                                    var submitResult = true;
                                    $('#form-attribute').ajaxSubmit({
                                        success: function (result) {
                                            if (result.code == 200) {
                                                app.loadAttributes(formId);
                                            } else {
                                                showResponseError($('#form-attribute'), result);
                                                submitResult = false;
                                            }
                                        }
                                    });
                                    return submitResult;
                                }
                            },
                            cancel: {text: '取消'}
                        }
                    });
                }
            },
            mounted: function () {
                this.loadForms();
            }
        })
    </script>
@endsection
