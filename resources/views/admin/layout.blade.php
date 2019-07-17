<!doctype html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <title>LyCMS后台管理系统</title>
    <link rel="icon" href="/favicon.ico" type="image/ico">
    <meta name="keywords" content="LyCMS后台管理系统">
    <meta name="description" content="LyCMS后台管理系统">
    <link rel="stylesheet" href="/lyear/css/bootstrap.min.css">
    <link rel="stylesheet" href="/lyear/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/lyear/css/style.min.css">
    <script type="text/javascript" src="/lyear/js/jquery.min.js"></script>
    <script type="text/javascript" src="/lyear/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/jquery.form.js"></script>
    <script type="text/javascript" src="/lyear/js/perfect-scrollbar.min.js"></script>
    <script type="text/javascript" src="/lyear/js/main.min.js"></script>
    <!--q-uploader-->
    <link rel="stylesheet" href="/js/uploader/q.css">
    <script type="text/javascript" src="/js/uploader/q.js"></script>
    <script type="text/javascript" src="/js/uploader/q.image.js"></script>
    <!--x-editable-->
    <link rel="stylesheet" href="/js/editable/x-editable.css">
    <script type="text/javascript" src="/js/editable/x-editable.min.js"></script>
    <!--弹窗-->
    <link rel="stylesheet" href="/lyear/js/jconfirm/jquery-confirm.min.css">
    <script type="text/javascript" src="/lyear/js/jconfirm/jquery-confirm.min.js"></script>
    <!--日期/时间选择插件-->
    <link rel="stylesheet" href="/lyear/js/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="/lyear/js/bootstrap-datepicker/bootstrap-datepicker3.min.css">
    <script type="text/javascript"
            src="/lyear/js/bootstrap-datepicker/locales/bootstrap-datepicker.zh-CN.min.js"></script>
    <script type="text/javascript" src="/lyear/js/bootstrap-datetimepicker/moment.min.js"></script>
    <script type="text/javascript" src="/lyear/js/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="/lyear/js/bootstrap-datetimepicker/locale/zh-cn.js"></script>
    <!--标签-->
    <link rel="stylesheet" href="/lyear/js/jquery-tags-input/jquery.tagsinput.min.css">
    <script type="text/javascript" src="/lyear/js/jquery-tags-input/jquery.tagsinput.min.js"></script>
    <!--联动-->
    <script type="text/javascript" src="/js/jquery.cxselect.min.js"></script>
    <!--kindeditor-->
    <script src="/js/kindeditor/kindeditor-all-min.js"></script>
    <!--vditor-->
    <link rel="stylesheet" href="/js/vditor/vditor.classic.css"/>
    <script src="/js/vditor/vditor.min.js"></script>
    <!--剪贴板-->
    <script type="text/javascript" src="/js/clipboard.min.js"></script>
    <!--百度地图-->
    <script type="text/javascript"
            src="http://api.map.baidu.com/api?v=2.0&ak=6a85063216e40050217dd26807eb39b9"></script>
    <link rel="stylesheet" href="/css/admin.css">
    <script type="text/javascript" src="/js/admin.js"></script>
</head>

<body>
<div class="lyear-layout-web">
    <div class="lyear-layout-container">
        <!--左侧导航-->
        <aside class="lyear-layout-sidebar">

            <!-- logo -->
            <div id="logo" class="sidebar-header">
                <a href="javascript:">
                    <img src="/logo.png" title="LightYear" style="height: 68px;margin: 0;" alt="LightYear"/>
                </a>
            </div>
            <div class="lyear-layout-sidebar-scroll">

                <nav class="sidebar-main">
                    <ul class="nav nav-drawer">
                        @foreach(Session::get('menus.tree', []) as $menu)
                            @if(!empty($menu['show']) && $menu['show']==1)
                                <li class="nav-item nav-item-has-subnav">
                                    <a href="javascript:void(0)" id="menu-{{$menu['id']}}"><i
                                                class="mdi {{$menu['icon']}}"></i> {{$menu['name']}}</a>
                                    @if(!empty($menu['children']))
                                        <ul class="nav nav-subnav">
                                            @foreach($menu['children'] as $child)
                                                @if(!empty($child['show']) && $child['show']==1)
                                                    <li><a href="{{$child['link'] ?? 'javascript:'}}"
                                                           id="menu-{{$child['id']}}">{{$child['name']}}</a></li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </nav>
            </div>

        </aside>
        <!--End 左侧导航-->

        <!--头部信息-->
        <header class="lyear-layout-header">

            <nav class="navbar navbar-default">
                <div class="topbar">

                    <div class="topbar-left">
                        <div class="lyear-aside-toggler">
                            <span class="lyear-toggler-bar"></span>
                            <span class="lyear-toggler-bar"></span>
                            <span class="lyear-toggler-bar"></span>
                        </div>
                        <span class="navbar-page-title">{{$page_title ?? ''}}</span>
                    </div>

                    <ul class="topbar-right">
                        <li class="dropdown dropdown-profile">
                            <a href="javascript:void(0)" data-toggle="dropdown">
                                <img class="img-avatar img-avatar-48 m-r-10" src="{{Auth::user()->avatar}}"
                                     alt="{{Auth::user()->name}}"/>
                                <span>{{Auth::user()->name}} <span class="caret"></span></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                    <a href="{{route('admin.profile')}}"><i class="mdi mdi-account"></i> 个人信息</a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="{{route('admin.logout')}}"><i class="mdi mdi-logout-variant"></i> 退出登录</a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown dropdown-skin">
                            <span class="icon-palette" onclick="uploadFile()"><i
                                        class="mdi mdi-cloud-upload"></i></span>
                        </li>
                        <!--切主题配色-->
                    @include('admin.theme')
                    <!--切换主题配色-->
                    </ul>
                </div>
            </nav>

        </header>
        <!--End 头部信息-->

        <!--页面主要内容-->
        <main class="lyear-layout-content">
            <div class="row layout-content" style="margin-top: 10px; margin-left: 15px;" id="app">
                @yield('main')
            </div>
        </main>
        <!--End 页面主要内容-->

        <!--alert-->
        <div id="alert-msg" class="alert alert-danger alert-dismissible admin-do-alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> <span class="msg-title"></span></h4>
            <span class="msg-content"></span>
        </div>
        <!--alert-->

    </div>
</div>
<script type="text/javascript">
    // 菜单
    var currentRoute = "{{request()->route()->getName()}}";
    var menus = @php echo json_encode(Session::get('menus.dict')); @endphp;
    var current_menu = parent_menu = 0;
    if (currentRoute && typeof(menus[currentRoute]) != 'undefined') {
        current_menu = menus[currentRoute];
        parent_menu = menus[current_menu].parent_id > 0 ? menus[current_menu].parent_id : 0;
        if (parent_menu > 0 && menus[parent_menu].parent_id > 0) {
            current_menu = parent_menu;
            parent_menu = menus[current_menu].parent_id > 0 ? menus[current_menu].parent_id : 0;
            console.log(parent_menu);
        }
    }
    $(function () {
        // 菜单
        $('#menu-' + parent_menu).parent('li').addClass('open');
        $('#menu-' + current_menu).parent('li').addClass('active');
        var pageTitle = $('#menu-' + current_menu).parent('li').text();
        if ($('.navbar-page-title').text() == '') {
            $('.navbar-page-title').text(pageTitle);
        }


        // 按钮事件
        $('.btn-action').click(function () {
            ajaxExecute(this);
        });
        $('.btn-delete').click(function () {
            ajaxDelete(this);
        });
        $('#btn-refresh').click(function () {
            window.location.reload();
        });
        $('.image-show').click(function () {
            showImage(this);
        });

        $('.editable').editable({
            emptytext: '空',
            success: function (response, newValue) {
                if (response.code == 4003) {
                    return response.message + '！' + response.data.value[0];
                } else if (response.code != 200) {
                    return response.message;
                }
            }
        });
    });
</script>
</body>
</html>