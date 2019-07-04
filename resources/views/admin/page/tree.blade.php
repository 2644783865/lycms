@extends('admin.layout')

@section('main')
    <script type="text/javascript" src="/js/vue.js"></script>
    <div class="card">
        <div class="card-body clearfix">
            @if(!empty($root))
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        @foreach($trees as $tab)
                            <li @if($tab->id==$root->id) class="active" @endif>
                                <a href="{{route('admin.tree')}}?root_id={{$tab->id}}">{{$tab->name}}</a>
                            </li>
                        @endforeach
                    </ul>

                    <form class="form-inline" id="list-form" action="{{route('admin.tree.root')}}"
                          method="post" onSubmit="return ajaxSubmit(this);">
                        <div class="form-group">
                            <input type="hidden" class="form-control" value="{{$root->id}}" name="root_id"/>
                            <input type="text" class="form-control" value="{{$root->name}}" name="name"/>
                            <div class="input-group">
                                <input type="text" class="form-control js-tags-input" value="{{$root->level}}"
                                       name="level" id="level" placeholder="层级名称"/>
                            <span class="input-group-btn">
                                <button class="btn btn-danger" type="submit"><i class="fa fa-search"></i>修改</button>
                            </span>
                            </div>
                        </div>

                        <div class="toolbar-btn-action pull-right">
                            <div class="btn-group">
                                <a class="btn btn-success m-r-5" v-on:click="createNode(-1)">
                                    <i class="mdi mdi-plus"></i>新增节点
                                </a>
                                <a class="btn btn-success m-r-5" href="javascript:" v-on:click="createRoot">
                                    <i class="mdi mdi-plus"></i>新增级联
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
        @else
            <div class="toolbar-btn-action">
                <a class="btn btn-success m-r-5" href="javascript:" v-on:click="createRoot">
                    <i class="mdi mdi-plus"></i>新增树
                </a>
            </div>
        @endif
    </div>

    <div class="card flex-1 scroll-y" v-if="tree_id && tree_nodes.length" v-cloak>
        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-responsive table-hover table-condensed" id="table-nodes">
                    <thead>
                    <tr>
                        <th class="col-sm-4">名称</th>
                        <th class="col-sm-3">状态</th>
                        <th class="col-sm-5">管理</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(tree_node,index) in tree_nodes" :id="tree_node.id" :pid="tree_node.parent_id">
                        <td>&nbsp;@{{tree_node.name}}</td>
                        <td><p v-if="tree_node.status==1">是</p>
                            <p v-else>否</p></td>
                        <td>
                            <div class="btn-group btn-group-xs-3">
                                <a :data-id="tree_node.id" class="btn btn-xs btn-info" v-on:click="editNode(index)"><i
                                            class="fa fa-edit"></i>编辑</a>
                                <a :data-href="'/admin/trees/'+tree_node.id" class="btn btn-xs btn-info"
                                   v-on:click="deleteNode(index,$event)"><i class="fa fa-remove"></i>删除</a>
                                <a :data-id="tree_node.id" class="btn btn-xs btn-info" v-on:click="createNode(index)"
                                   v-if="tree_node.depth < tree_node.max_depth"><i class="fa fa-plus"></i>子菜单</a>
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
                tree_id:{{$root->id??0}},
                tree_nodes: []
            },
            methods: {
                loadNodes: function () {
                    var url = '/admin/trees/' + this.tree_id + '/nodes';
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
                createRoot: function () {
                    $.confirm({
                        title: '新增树',
                        columnClass: 'col-md-4 col-md-offset-4',
                        content: '' +
                        '<form class="form-horizontal col-md-12" action="{{route('admin.tree.root')}}" style="margin-top:20px" id="form-root" method="post">' +
                        '<div class="form-group"><label class="control-label"><span class="form-required">*</span>名称</label><input type="text" class="form-control col-sm-12" name="name" required /></div>' +
                        '<div class="form-group"><label class="control-label"><span class="form-required">*</span>层级</label><input type="text" class="form-control  col-sm-12 js-tags-input" name="level" required /></div>' +
                        '</form>',
                        buttons: {
                            formSubmit: {
                                text: '保存',
                                btnClass: 'btn-danger',
                                action: function () {
                                    var submitResult = true;
                                    $('#form-root').ajaxSubmit({
                                        success: function (result) {
                                            if (result.code == 200) {
                                                if ($('.nav-tabs').length) {
                                                    var liStr = '<li><a href="/admin/trees?root_id=' + result.data.id + '">' + result.data.name + '</a></li>';
                                                    $('.nav-tabs').append(liStr);
                                                } else {
                                                    window.location.reload();
                                                }
                                            } else {
                                                showResponseError($('#form-root'), result);
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
                    setTimeout(function () {
                        $("#form-root").find(".js-tags-input").tagsInput({
                            height: "36px",
                            width: "100%",
                            defaultText: "层级",
                            removeWithBackspace: true,
                            delimiter: [","]
                        });
                    }, 500);
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
                        columnClass: 'col-md-4 col-md-offset-4',
                        content: '' +
                        '<form class="form-horizontal col-md-12" action="{{route('admin.tree.store')}}" style="margin-top:20px" id="form-node" method="post">' +
                        '<div class="form-group"><label class="control-label">名称</label><input type="text" class="form-control" name="name" value="" /></div>' +
                        '<div class="form-group"><label class="control-label">父级</label>' +
                        '<input type="text" class="form-control" value="' + pname + '" readonly /><input type="hidden" name="parent_id" value="' + pid + '" ></div>' +
                        '<div class="form-group"><label class="control-label">排序</label><div class="form-inline">' +
                        '<input type="text" class="form-control" name="sort" value="" style="width:80px;" placeholder="排序" />&nbsp;' +
                        '<select class="form-control" name="status"><option value="1">启用</option><option value="2">禁用</option></select></div></div>' +
                        '<div class="form-group"><label class="control-label">备注</label><textarea name="remark" class="form-control" rows="4" cols="80"></textarea></div>' +
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
                    var url = '/admin/trees/' + item.id;
                    var selected = [
                        item.status == 1 ? 'selected="selected"' : '',
                        item.status == 2 ? 'selected="selected"' : ''
                    ];
                    var pname = item.parent_name ? item.parent_name : '顶级';
                    $.confirm({
                        title: '修改节点',
                        columnClass: 'col-md-4 col-md-offset-4',
                        content: '' +
                        '<form class="form-horizontal col-md-12" action="' + url + '" style="margin-top:20px" id="form-node" method="post">' +
                        '<div class="form-group"><label class="control-label">名称</label><input type="text" class="form-control" name="name" value="' + item.name + '" /></div>' +
                        '<div class="form-group"><label class="control-label">父级</label>' +
                        '<input type="text" class="form-control" value="' + pname + '" readonly /></div>' +
                        '<div class="form-group"><label class="control-label">排序</label><div class="form-inline">' +
                        '<input type="text" class="form-control" name="sort" value="' + item.sort + '" style="width:80px;" placeholder="排序" />&nbsp;' +
                        '<select class="form-control" name="status"><option value="1"  ' + selected[0] + '>启用</option><option value="2"  ' + selected[1] + '>禁用</option></select></div></div>' +
                        '<div class="form-group"><label class="control-label">备注</label><textarea name="remark" class="form-control" rows="4" cols="80" value="' + 2 + '"></textarea></div>' +
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
