<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>归档</title>
    <meta name="keywords" content="blog"/>
    <meta name="description" content="blog"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/blog/css/base.css" rel="stylesheet">
    <link href="/blog/css/m.css" rel="stylesheet">
    <script src="/blog/js/jquery-1.8.3.min.js"></script>
    <script src="/blog/js/comm.js"></script>
    <script src="/blog/js/page.js"></script>
</head>
<body>
@component('blog.component.header', ['current'=>'archive']) @endcomponent
<article>
    <div class="whitebg timebox">
        <h2 class="htitle">往期文章</h2>
        <ul id="list">
            @foreach($articles as $item)
                <li>
                    <span>{{$item->created_at->format('Y年m月d日')}}</span>
                    <i><a href="{{route('blog.show', [$item->id])}}" target="_blank">{{$item->title}}</a></i>
                </li>
            @endforeach
        </ul>
    </div>
</article>
@component('blog.component.footer') @endcomponent
</body>
</html>