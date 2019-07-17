<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LyCMS</title>
    <meta name="description" content="网站描述"/>
    <meta name="keywords" content="关键词"/>
    <link rel="stylesheet" type="text/css" href="/company/style/pintuer.css"/>
    <link rel="stylesheet" type="text/css" href="/company/style/owl.carousel.css"/>
    <link rel="stylesheet" type="text/css" href="/company/style/style.css"/>
    <script type="text/javascript" src="/company/js/jquery.min.js"></script>
    <script type="text/javascript" src="/company/js/pintuer.js"></script>
    <!-- FOR IE9 below --><!--[if lt IE 9]>
    <script src="/company/js/respond.js"></script>
    <![endif]-->
</head>
<body>
@component('company.component.header',['current'=>'index']) @endcomponent

<!-- 轮播图片 begin-->
<div class="layout">
    <div class="line">
        <div class="flexslider">
            <ul class="slides">
                @foreach($service->getAd('企业站首页banner') as $banner)
                    <li>
                        <a href="{{$banner->target ? $banner->target : '/'}}" target="_blank">
                            <img src="{{$banner->image ? $banner->image : ''}}" alt="幻灯片"/>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
<div class="blankbig"></div>
<!-- 轮播图片 end-->

<!-- 关于我们 begin-->
<div id="fh5co-about-us">
    <div class="container">
        <div class="line-big">
            <div class="xl12 xs6 xm3 xb3 text-center padding-big-bottom">
                <div class="border-radius padding-large-bottom">
                    <div class="media-img"><img src="/company/images/newpic/webdesign_1.png" alt="模板网页制作"/></div>
                    <h2 class="padding-big-top">模板网页制作</h2>
                    <p class="padding-big-top">纯手工模板建站，绝非自助建站,更容易扩展,更适合推广优化</p>
                </div>
            </div>
            <div class="xl12 xs6 xm3 xb3 text-center padding-big-bottom">
                <div class="border-radius padding-large-bottom">
                    <div class="media-img"><img src="/company/images/newpic/webdesign_2.png" alt="定制网站制作"/></div>
                    <h2 class="padding-big-top">定制网站制作</h2>
                    <p class="padding-big-top">广州响应式网页制作,为您量身订制专属网站，更好的用户体验和转化率</p>
                </div>
            </div>
            <div class="xl12 xs6 xm3 xb3 text-center padding-big-bottom">
                <div class="border-radius padding-large-bottom">
                    <div class="media-img"><img src="/company/images/newpic/webdesign_3.png" alt="商城网站制作"/></div>
                    <h2 class="padding-big-top">商城网站制作</h2>
                    <p class="padding-big-top">电脑端+手机端+微信端+强大的分销推广系统，完美网上商城解决方案</p>
                </div>
            </div>
            <div class="xl12 xs6 xm3 xb3 text-center padding-big-bottom">
                <div class="border-radius padding-large-bottom">
                    <div class="media-img"><img src="/company/images/newpic/webdesign_4.png" alt="系统平台开发"/></div>
                    <h2 class="padding-big-top">系统平台开发</h2>
                    <p class="padding-big-top">APP开发,微信开发,B2B2C平台,多用户平台网站开发</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="blankbig"></div>
<!-- 关于我们 end-->

<!-- 案例展示 begin-->
<div id="fh5co-content_show">
    <div class="container">
        <div class="line">
            <div class="x12 text-center">
                <h2 class="full-screen-en-title">客户案例</h2>
                <p class="text-big padding-big-top">我们一直致力于网页制作美感与营销的完美融合,在访客面前展现你的实力和企业形象</p>
            </div>
        </div>
        <ul class="nav text-center margin-big-middle-top margin-big-middle-bottom">
            @foreach($service->getSubCategories('案例') as $item)
                <li><a href="{{route('company.case')}}?cid={{$item['id']}}"><span>{{$item['name']}}</span></a></li>
            @endforeach
        </ul>
        <div class="line show_content">
            <div class="show_list">
                <div class="tab-panel">
                    <div class="container">
                        <div class="line-middle">
                            @foreach($cases as $case)
                                <div class="xl6 xs4 xb4 xm4 fh5co-gallery margin-bottom">
                                    <div class="gallery-item">
                                        <img src="{{$case->cover}}" alt="{{$case->title}}"/>
                                        <div class="overlay">
                                            <h3 class="hidden-s hidden-l">{{$case->title}}</h3>
                                            <p class="hidden-s hidden-l"></p>
                                            <a href="{{route('company.case-show',[$case->id])}}" class="bnt-case">+</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="line text-center margin-large-top"><a class="more border-main" href="{{route('company.case')}}">更多案例</a>
    </div>
</div>
<div class="blankbig"></div>
<!-- 案例展示 end-->

<!-- 为什么选择我们 begin-->
<div id="fh5co-why-us">
    <div class="container">
        <div class="line padding-big-top">
            <div class="x12 text-center">
                <h2 class="full-screen-en-title">移动来袭</h2>
                <p class="text-big padding-big-top">5亿人都在用手机浏览网页，您的手机网站准备好了吗？</p>
            </div>
        </div>
        <div class="show-content line-big">
            <div class="xl12 xs12 xm4 xb4">
                <div class="item item1 item-text">
                    <table>
                        <tr>
                            <td><img src="/company/images/newpic/wl1.jpg" alt="错过了，传统行业的高速发展期！"/></td>
                            <td class="tdpad">错过了，传统行业的高速发展期！</td>
                        </tr>
                        <tr>
                            <td><img src="/company/images/newpic/wl2.jpg" alt="错过了，PC端互联网时代的绝佳机会！"/></td>
                            <td class="tdpad">错过了，PC端互联网时代的绝佳机会！</td>
                        </tr>
                        <tr>
                            <td><img src="/company/images/newpic/wl3.jpg" alt="你还想错过移动互联网？2014年起，百度移动搜索开始取消PC网页收录。"/>
                            </td>
                            <td class="tdpad">你还想错过移动互联网？2014年起，百度移动搜索开始取消PC网页收录。</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="xl12 xs12 xm4 xb4">
                <div class="item item2">
                    <div class="banner-img text-center"><img src="/company/images/newpic/mobile.png" alt="移动来袭"/></div>
                </div>
            </div>
            <div class="xl12 xs12 xm4 xb4">
                <div class="item item3 item-text">
                    <table>
                        <tr>
                            <td><img src="/company/images/newpic/wr1.jpg" alt="响应式H5网站制作技术，一个网站适应不同终端。"/></td>
                            <td class="tdpad">响应式H5网站制作技术，一个网站适应不同终端。</td>
                        </tr>
                        <tr>
                            <td><img src="/company/images/newpic/wr2.jpg" alt="同时抢占手机PC端搜索结果，让商机滴水不漏，随时随地做生意"/></td>
                            <td class="tdpad">同时抢占手机PC端搜索结果，让商机滴水不漏，随时随地做生意</td>
                        </tr>
                        <tr>
                            <td><img src="/company/images/newpic/wr3.jpg" alt="方便快速分享转发，实现高效移动办公。"/></td>
                            <td class="tdpad">方便快速分享转发，实现高效移动办公。</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 为什么选择我们 end-->
<!--评论开始-->
<div class="layout" id="fh5co-comment-list">
    <div class="bg-comment">
        <div class="container">
            <div class="line">
                <div class="x12 text-center padding-top">
                    <h2 class="full-screen-en-title">客户反馈</h2>
                    <p class="text-big padding-big-top margin-large-bottom">客户评价聚焦，让您全方位深入地了解我们广州网页制作公司百度一下</p>
                </div>
            </div>
            <div class="line show-list">
                <div class="owl-carousel comment-carousel-carousel">
                    <div class="item text-center">
                        <div class="media-img"><img src="/company/uploads/1-1F523210P30-L.png" alt="索菲亚"/></div>
                        <div class="quote-txt left-quote"><span class="icon-quote-left"></span></div>
                        <div class="intro text-default">
                            <p> 我们本身也有开发团队，但并不是无所不能的。至少在网页制作板块，我们深刻体会到了来自广州网站制作公司艾迪创想的专业 </p>
                        </div>
                        <div class="signature"><a href="http://www.baidu.com/" target="_blank">索菲亚</a></div>
                        <div class="quote-txt right-quote"><span class="icon-quote-right"></span></div>
                    </div>
                    <div class="item text-center">
                        <div class="media-img"><img src="/company/uploads/1-1F523210K1420.png" alt="大王山森林公园"/></div>
                        <div class="quote-txt left-quote"><span class="icon-quote-left"></span></div>
                        <div class="intro text-default">
                            <p> 前前后后我们也找了几家网站制作公司来进行对比，作为政府部门，无论是费用，还是审核，同别的单位有很大的不同，艾迪创想更有耐心</p>
                        </div>
                        <div class="signature"><a href="http://www.baidu.com/" target="_blank">大王山森林公园</a></div>
                        <div class="quote-txt right-quote"><span class="icon-quote-right"></span></div>
                    </div>
                    <div class="item text-center">
                        <div class="media-img"><img src="/company/uploads/1-1F5232053000-L.png" alt="师傅在线"/></div>
                        <div class="quote-txt left-quote"><span class="icon-quote-left"></span></div>
                        <div class="intro text-default">
                            <p> 广州网页制作公司-艾迪创想是一个很朝气蓬勃的团队，也是一个很积极向上的团队，每一次沟通合作，总能给我们带来新的东西... </p>
                        </div>
                        <div class="signature"><a href="http://www.baidu.com/" target="_blank">师傅在线</a></div>
                        <div class="quote-txt right-quote"><span class="icon-quote-right"></span></div>
                    </div>
                    <div class="item text-center">
                        <div class="media-img"><img src="/company/uploads/1-1F5232052120-L.png" alt="智升电子科技"/></div>
                        <div class="quote-txt left-quote"><span class="icon-quote-left"></span></div>
                        <div class="intro text-default">
                            <p> 前前后后在广州网站制作公司艾迪创想这里做了5个站，五个都有非常不错的排名，艾迪创想非常擅长网站推广运营... </p>
                        </div>
                        <div class="signature"><a href="http://www.baidu.com/" target="_blank">智升电子科技</a></div>
                        <div class="quote-txt right-quote"><span class="icon-quote-right"></span></div>
                    </div>
                    <div class="item text-center">
                        <div class="media-img"><img src="/company/uploads/1-1F5232051400-L.png" alt="呐喊美术商城"/></div>
                        <div class="quote-txt left-quote"><span class="icon-quote-left"></span></div>
                        <div class="intro text-default">
                            <p> 呐喊美术商城能顺利融到资，艾迪创想功不可没，我本人是一个美术专业的人，我们这个系统的要求非常高，感谢艾迪创想的耐心和细致</p>
                        </div>
                        <div class="signature"><a href="http://www.baidu.com/" target="_blank">呐喊美术商城</a></div>
                        <div class="quote-txt right-quote"><span class="icon-quote-right"></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="blankbig"></div>
<!--评论结束-->
<!-- 观点 begin-->
<div id="fh5co-news-list">
    <div class="container">
        <div class="line">
            <div class="x12 text-center">
                <h2 class="full-screen-en-title">观点资讯</h2>
                <p class="text-big padding-big-top">互联网+时代，说建站，谈运营与网络营销</p>
            </div>
        </div>
        <div class="blankbig"></div>
        <div class="line-big">
            @foreach($news as $item)
                <div class="xl12 xs6 xm6 xb4 margin-large-bottom">
                    <div class="media">
                        <div class="media-left float-left">
                            <p class="f-day padding-big-top">{{$item->created_at->format('d')}}</p>
                            <p class="f-year padding-top">{{$item->created_at->format('y-m')}}</p>
                        </div>
                        <div class="media-body">
                            <h3 class="text-default">
                                <a href="{{route('company.news-show',[$item->id])}}"
                                   title="{{$item->title}}">{{$item->title}}</a>
                            </h3>
                            <p>{{empty($item->attr_map['intro']) ? $item->title : mb_substr($item->attr_map['intro'],0,40)}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="line text-center margin-large-top">
            <a class="more border-main" href="{{route('company.news')}}">更多观点</a>
        </div>
    </div>
</div>
<div class="blankbig"></div>
<!-- 观点 end-->
@component('company.component.footer') @endcomponent
</body>
</html>