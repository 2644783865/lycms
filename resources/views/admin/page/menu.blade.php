@extends('admin.layout')

@section('main')
    <script type="text/javascript" src="/js/vue.js"></script>
    <div class="card">
        <div class="card-body clearfix">
            <div class="toolbar-btn-action pull-right">
                <a class="btn btn-success m-r-5" v-on:click="createNode(-1)">
                    <i class="mdi mdi-plus"></i>新增菜单
                </a>
            </div>
        </div>
    </div>

    <div class="card flex-1 scroll-y" v-if="tree_id && tree_nodes.length" v-cloak>
        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-responsive table-hover table-condensed" id="table-nodes">
                    <thead>
                    <tr>
                        <th class="col-sm-3">名称</th>
                        <th class="col-sm-2">控制器</th>
                        <th class="col-sm-2">显示</th>
                        <th class="col-sm-5">管理</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(tree_node,index) in tree_nodes" :id="tree_node.id" :pid="tree_node.parent_id">
                        <td>&nbsp;<a :href="tree_node.link ? tree_node.link : 'javascript:'"
                                     :title="tree_node.link ? tree_node.link : ''">@{{tree_node.name}}</a></td>
                        <td>@{{tree_node.controller ? (tree_node.controller+'@'+tree_node.action) : tree_node.action}}</td>
                        <td><p v-if="tree_node.show==1">是</p><p v-else>否</p></td>
                        <td>
                            <div class="btn-group btn-group-xs-3">
                                <a class="btn btn-xs btn-info" v-on:click="editNode(index)"><i
                                            class="fa fa-edit"></i>编辑</a>
                                <a :data-href="'/admin/menus/'+tree_node.id" class="btn btn-xs btn-info"
                                   v-on:click="deleteNode(index,$event)"><i class="fa fa-remove"></i>删除</a>
                                <a class="btn btn-xs btn-info" v-on:click="createNode(index)"><i
                                            class="fa fa-plus"></i>子菜单</a>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <link rel="stylesheet" href="/js/jquery-treeTable/jquery.treeTable.css" type="text/css">
    <script type="text/javascript" src="/js/jquery-treeTable/jquery.treeTable.js"></script>
    <script type="text/javascript">
        $.ajaxSettings.async = false;
        var treeTable;
        var app = new Vue({
            el: '#app',
            data: {
                tree_id: 1,
                tree_nodes: []
            },
            methods: {
                loadNodes: function () {
                    var url = '/admin/menus/nodes';
                    var nodes = [];
                    $.get(url, function (result) {
                        if (result.code == 200) {
                            nodes = result.data;
                        }
                    });
                    this.tree_nodes = nodes;
                    this.$nextTick(function () {
                        $('.tree_table span').remove();
                        $('#table-nodes').treeTable({expandLevel: 5});
                    });
                },
                deleteNode: function (index, event) {
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
                                                app.loadNodes();
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
                createNode: function (index) {
                    var pname = '顶级';
                    var pid = this.tree_id;
                    if (index > -1) {
                        var item = this.tree_nodes[index];
                        pname = item.name;
                        pid = item.id;
                    }
                    $.confirm({
                        title: '新增节点',
                        columnClass: 'col-md-6 col-md-offset-3',
                        content: '' +
                        '<form class="form-horizontal col-md-12" action="/admin/menus/create" style="margin-top:20px" id="form-node" method="post">' +
                        '<div class="form-group"><label class="control-label">名称</label><input type="text" class="form-control" name="name" value="" /></div>' +
                        '<div class="form-group"><label class="control-label">父级</label>' +
                        '<input type="text" class="form-control" value="' + pname + '" readonly /><input type="hidden" name="parent_id" value="' + pid + '" ></div>' +
                        '<div class="form-group"><label class="control-label">链接地址</label><input type="text" class="form-control" name="link" value="" /></div>' +
                        '<div class="form-group"><label class="control-label">控制器</label><div class="form-inline">' +
                        '<input type="text" class="form-control" name="controller" value="" placeholder="控制器名称" />' +
                        '<input type="text" class="form-control" name="action" value="" placeholder="操作名称" /></div></div>' +
                        '<div class="form-group"><label class="control-label">显示</label><div class="form-inline">' +
                        '<input type="text" class="form-control" style="width:80px;" name="sort" value="" placeholder="排序" /> ' +
                        '<input type="text" class="form-control" style="width:120px;" name="icon" value="" placeholder="icon" /> ' +
                        '<select class="form-control" name="show"><option value="1">显示</option><option value="2">不显示</option></select></div></div>' +
                        '</form>',
                        buttons: {
                            formSubmit: {
                                text: '保存',
                                btnClass: 'btn-danger',
                                action: function () {
                                    var submitResult = true;
                                    $('#form-node').ajaxSubmit({
                                        success: function (result) {
                                            if (result.code == 200) {
                                                app.loadNodes();
                                            } else {
                                                showResponseError($('#form-node'), result);
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
                editNode: function (index) {
                    var item = this.tree_nodes[index];
                    var url = '/admin/menus/' + item.id;
                    var pname = item.parent_name ? item.parent_name : '顶级';
                    var selected = [
                        item.show == 1 ? 'selected="selected"' : '',
                        item.show == 2 ? 'selected="selected"' : ''
                    ];
                    $.confirm({
                        title: '修改节点',
                        columnClass: 'col-md-6 col-md-offset-3',
                        content: '' +
                        '<form class="form-horizontal col-md-12" action="' + url + '" style="margin-top:20px" id="form-node" method="post">' +
                        '<div class="form-group"><label class="control-label">名称</label><input type="text" class="form-control" name="name" value="' + item.name + '" /></div>' +
                        '<div class="form-group"><label class="control-label">父级</label><input type="text" class="form-control" value="' + pname + '" readonly /></div>' +
                        '<div class="form-group"><label class="control-label">链接地址</label><input type="text" class="form-control" name="link" value="' + item.link + '" /></div>' +
                        '<div class="form-group"><label class="control-label">控制器</label><div class="form-inline">' +
                        '<input type="text" class="form-control" name="controller" value="' + item.controller + '" placeholder="控制器名称"/> ' +
                        '<input type="text" class="form-control" name="action" value="' + item.action + '" placeholder="操作名称" /></div></div>' +
                        '<div class="form-group"><label class="control-label">显示</label><div class="form-inline">' +
                        '<input type="text" class="form-control" name="sort" value="' + item.sort + '" style="width:80px;" placeholder="排序" /> ' +
                        '<input type="text" class="form-control" name="icon" value="' + item.icon + '" style="width:120px;" placeholder="icon" /> ' +
                        '<select class="form-control" name="show"><option value="1"  ' + selected[0] + '>显示</option><option value="2"  ' + selected[1] + '>不显示</option></select></div></div>' +
                        '</form>',
                        buttons: {
                            formSubmit: {
                                text: '保存',
                                btnClass: 'btn-danger',
                                action: function () {
                                    var submitResult = true;
                                    $('#form-node').ajaxSubmit({
                                        success: function (result) {
                                            if (result.code == 200) {
                                                app.loadNodes();
                                            } else {
                                                showResponseError($('#form-node'), result);
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
            created: function () {
                this.loadNodes();
            }
        });
    </script>
@endsection
