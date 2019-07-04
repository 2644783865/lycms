<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{$article->title}}</title>
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
@component('blog.component.header', ['current'=>'detail']) @endcomponent
<!--top end-->
<article>
    <!--lbox begin-->
    <div class="lbox">
        <div class="content_box whitebg">
            <h2 class="htitle">
                <span class="con_nav">您现在的位置是：<a href="/">首页</a> > <a href="{{route('blog.category', [$article->attr_map['blog_category']['id']])}}">{{$article->attr_map['blog_category']['name']??''}}</a></span>
                {{$article->attr_map['blog_category']['name']??''}}
            </h2>
            <h1 class="con_tilte">{{$article->title}}</h1>
            <div class="bloginfo">
                <span>{{$article->created_at->format('Y年m月d日')}}</span>
                <span><a href="{{route('blog.category', [$article->attr_map['blog_category']['id']])}}">【{{$article->attr_map['blog_category']['name']??''}}】</a></span>
                <span>
                    @foreach($article->tags as $tag)
                    <a href="{{route('blog.tag', [$tag])}}">{{$tag}}</a>
                    @endforeach
                </span>
            </div>
            <div class="con_info">
                <b>简介</b>
                个人博客，用来做什么？我刚开始就把它当做一个我吐槽心情的地方，也就相当于一个网络记事本，写上一些关于自己生活工作中的小情小事，也会放上一些照片，音乐。每天工作回家后就能访问自己的网站，一边听着音乐，一边写写文章。
            </div>
            <div class="con_text">
                <div>{{$article->attr_map['blog_content']}}</div>
                <div><span class="diggit">很赞哦！ ({{$article->page_view}}人围观)</span></div>
                <div class="nextinfo">
                    @if(!empty($article->prev))<p>上一篇：<a href="{{route('blog.show',[$article->prev->id])}}">{{$article->prev->title}}</a></p> @endif
                    @if(!empty($article->next))<p>下一篇：<a href="{{route('blog.show',[$article->next->id])}}">{{$article->next->title}}</a></p> @endif
                </div>
            </div>
        </div>
    </div>
    <!--lbox end-->
    <div class="rbox">
        @component('blog.component.sidebar-ad', ['ad'=>$service->getAd(4, 1)]) @endcomponent
        @component('blog.component.hot', ['articles'=>$service->getHot(6)]) @endcomponent
        @component('blog.component.sidebar-ad', ['ad'=>$service->getAd(5, 1)]) @endcomponent
        @component('blog.component.tag', ['tags'=>[]]) @endcomponent
    </div>
</article>
@component('blog.component.footer') @endcomponent
</body>
</html>