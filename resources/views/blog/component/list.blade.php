@foreach($articles as $article)
    <li>
        <h3 class="blogtitle"><a href="{{route('blog.show',[$article->id])}}" target="_blank">
                {{$article->title}}
            </a>
        </h3>
        @if($article->cover)
            <span class="blogpic imgscale">
			<i><a href="{{route('blog.category',[$article->id])}}">{{$article->attr_map['blog_category']['name']??''}}</a></i>
			<a href="{{route('blog.show',[$article->id])}}" title="">
				<img src="{{$article->cover??'/blog/images/b01.jpg'}}" alt="">
			</a>
		</span>
        @endif
        <p class="blogtext">{{empty($article->attr_map['blog_summary']) ? mb_substr($article->attr_map['blog_content'], 0, 200) : mb_substr($article->attr_map['blog_summary'], 0, 200)}}</p>
        <p class="bloginfo">
            <span>{{$article->created_at->format('Y年m月d日')}}</span>
			<span>
			【<a href="{{route('blog.category',[$article->id])}}">{{$article->attr_map['blog_category']['name']??''}}</a>】
			</span>
			<a href="{{route('blog.show',[$article->id])}}" class="viewmore">阅读更多</a>
        </p>
    </li>
@endforeach
