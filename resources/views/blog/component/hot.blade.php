@if($articles)
    <div class="whitebg paihang">
        <h2 class="htitle">{{$title??'博文推荐'}}</h2>
        @foreach($articles as $item)
            @if($loop->first)
                <section class="topnews imgscale">
                    <a href="{{route('blog.show',[$item->id])}}">
                        <img src="{{$item->cover??'/blog/images/h1.jpg'}}"/>
                        <span>{{$item->title}}</span>
                    </a>
                </section>
            @endif
        @endforeach
        <ul>
            @foreach($articles as $item)
                @if(!$loop->first)
                    <li><i></i><a href="{{route('blog.show',[$item->id])}}">{{$item->title}}</a></li>
                @endif
            @endforeach
        </ul>
    </div>
@endif