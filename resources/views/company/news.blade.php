<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>资讯_LyCMS</title>
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
<body class="list_body list4" style="background:#f2f2f2">
@component('company.component.header',['current'=>'news']) @endcomponent

<!-- 轮播图片 begin-->
<div class="layout">
    <div class="banner">
        <div class="item"><img src="/company/images/banner/news.jpg"></div>
    </div>
</div>
<div class="blankbig"></div>
<!-- 轮播图片 end-->
<!-- 内容展示 begin-->
<div id="fh5co-content_show">
    <div class="container">
        <div class="line">
            <div class="x12 text-center margin-big-middle-bottom">
                <h2 class="full-screen-en-title">观点</h2>
                <p class="text-big padding-big-top">观点报告</p>
            </div>
        </div>
        <ul class="nav text-center margin-big-middle-bottom">
            @foreach($service->getSubCategories('资讯') as $item)
                <li><a href='{{route('company.news')}}?cid={{$item['id']}}'>{{$item['name']}}</a></li>
            @endforeach
        </ul>
    </div>
    <div class="list-content">
        <!-- 瀑布流样式开始 -->
        <div class="waterfull clearfloat" id="waterfull">
            <ul class="masonry">

                @foreach($pager as $item)
                    <li class="item masonry-brick">
                        <div class="imgholder">
                            <a href="{{route('company.news-show',[$item->id])}}">
                                <img src='{{$item->cover}}'/>
                            </a>
                        </div>
                        <div class="bitem">
                            <div class="title"><a href="newsshow.html">{{$item->title}}</a></div>
                            <div class="meta">{{$item->crated_at}}</div>
                            <div class="info">
                                {{$item->title}}
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="container">
        <div class="line">
            <div class="pagess">
                {!! $pager->appends($_GET)->links('company.page') !!}
            </div>
        </div>
    </div>
</div>
<div class="blankbig"></div>
<!-- 内容展示 end-->
<script type="text/javascript" src="/company/js/waterfull.js"></script>
@component('company.component.footer') @endcomponent
</body>
</html>