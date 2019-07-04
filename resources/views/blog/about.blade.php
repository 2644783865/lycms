<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>关于我</title>
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
@component('blog.component.header', ['current'=>'about']) @endcomponent
<article>
    <div class="whitebg about">
        <div class="ab_box"><i class="avatar_pic"><img src="https://avatars3.githubusercontent.com/u/2985405?s=460&v=4"></i>
            <h3>1024</h3>
            <p>因为喜欢，所以热爱。</p>
            <p>长时间的学习，每天脑子里都是代码，逐渐从单一的字母，一点一点堆砌成自己的技术长城。</p>
        </div>
        <h2 class="gd_title">内心独白</h2>
        <p class="ab_dubai">
            本人学识渊博、经验丰富，代码风骚、效率恐怖，C/C++、java、php无不精通，熟练掌握各种框架，深山苦练20余年，一天只睡4个小时，千里之外定位问题，瞬息之间修复上线。身体强壮、健步如飞，可连续编程100小时不休息，讨论技术方案5小时不喝水，上至带项目、出方案，下至盗账号、威胁PM，啥都能干。泡面矿泉水已准备好，学校不支持编程已辍学，家人不支持编程已断绝关系，老婆不支持编程已离婚，小孩不支持编程已送孤儿院，备用电源万兆光纤永不断电断网，门口已埋雷无人打扰。
        </p>
        <h2 class="gd_title">我的博客</h2>
        <ul class="myblog">
            <li>
                <b>创建时间</b>
                <p>2019年01月01日</p>
                <p><a href="{{route('blog.index')}}" target="_blank" class="buttons">主页</a></p>
            </li>
            <li><b>网站程序</b>
                <p>Lycms</p>
                <p><a href="https://github.com/yeosz/lycms" target="_blank" class="buttons">源码</a></p>
            </li>
            <li>
                <b>社交</b>
                <p>Github</p>
                <a href="https://github.com/yeosz" target="_blank" class="buttons">Github</a>
            </li>
        </ul>
    </div>
</article>
@component('blog.component.footer') @endcomponent
</body>
</html>