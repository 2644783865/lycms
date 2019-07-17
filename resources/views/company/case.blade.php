<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>案例_LyCMS</title>
    <meta name="description" content="网站描述"/>
    <meta name="keywords" content="关键词"/>
    <link rel="stylesheet" type="text/css" href="/company/style/pintuer.css"/>
    <link rel="stylesheet" type="text/css" href="/company/style/owl.carousel.css"/>
    <link rel="stylesheet" type="text/css" href="/company/style/style.css"/>
    <script type="text/javascript" src="/company/js/jquery.min.js"></script>
    <script type="text/javascript" src="/company/js/pintuer.js"></script>
    <!-- FOR IE9 below --><!--[if lt IE 9]>
    <script src="/company/js/respond.js"></script><![endif]-->
</head>
<body class="list_body list3">
@component('company.component.header',['current'=>'case']) @endcomponent
<!-- 轮播图片 begin-->
<div class="layout">
    <div class="banner">
        <div class="item"><img src="/company/images/banner/contact.jpg"></div>
    </div>
</div>
<div class="blankbig"></div>
<!-- 轮播图片 end-->
<!-- 内容展示 begin-->
<div id="fh5co-content_show" class="padding-big-top">
    <div class="container">
        <div class="line">
            <div class="x12 text-center">
                <h2 class="full-screen-en-title">案例</h2>
                <p class="text-big padding-big-top">我们要做的是从零开始 重塑每一个必要元素 并将其融合在看上去简单的设计之中</p>
            </div>
        </div>
        <ul class="nav text-center margin-big-middle-top">
            @foreach($service->getSubCategories('案例') as $item)
                <li><a href='{{route('company.case')}}?cid={{$item['id']}}'>{{$item['name']}}</a></li>
            @endforeach
        </ul>
        <div class="blankbig"></div>
        <div class="line show_content">
            <div class="show_list">
                <div class="tab-panel">
                    <div class="container">
                        <div class="line-middle">
                            @foreach($pager as $item)
                                <div class="xl6 xs4 xb4 xm4 fh5co-gallery margin-bottom">
                                    <div class="gallery-item">
                                        <img src='{{$item->cover}}'/>
                                        <div class="overlay">
                                            <h3 class="hidden-s hidden-l">{{$item->name}}</h3>
                                            <p class="hidden-s hidden-l">{{$item->title}}</p>
                                            <a href="{{route('company.case-show',[$item->id])}}"
                                               target="_blank" class="bnt-case">+</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="pagess">
                {!! $pager->appends($_GET)->links('company.page') !!}
            </div>
        </div>
    </div>
</div>
<div class="blankbig"></div>
@component('company.component.footer') @endcomponent
</body>
</html>