<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>首页</title>
    <meta name="keywords" content="blog"/>
    <meta name="description" content="blog"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/blog/css/base.css" rel="stylesheet">
    <link href="/blog/css/m.css" rel="stylesheet">
    <script src="/blog/js/jquery-1.8.3.min.js"></script>
    <script src="/blog/js/comm.js"></script>
    <!--[if lt IE 9]>
    <script src="/blog/js/modernizr.js"></script>
    <![endif]-->
</head>
<body>
@component('blog.component.header', ['current'=>'index']) @endcomponent
<article>
    <div class="lbox">
        @if($ad=$service->getAd(2, 1))
        <div class="ad whitebg"><img src="{{$ad->image}}"></div>
        @endif
        <div class="whitebg bloglist">
            <h2 class="htitle">最新博文</h2>
            <ul>
                @component('blog.component.list', ['articles'=>$service->getNew(10)]) @endcomponent
            </ul>
        </div>
    </div>
    <div class="rbox">
        @component('blog.component.hot', ['articles'=>$service->getHot(6)]) @endcomponent
        @component('blog.component.sidebar-ad', ['ad'=>$service->getAd(4, 1)]) @endcomponent
        @component('blog.component.top', ['articles'=>$service->getTop(6)]) @endcomponent
        @component('blog.component.sidebar-ad', ['ad'=>$service->getAd(5, 1)]) @endcomponent
    </div>
</article>
@component('blog.component.footer') @endcomponent
</body>
</html>