@if($articles)
    <div class="whitebg tuijian">
        <h2 class="htitle">{{$title??'点击排行'}}</h2>
        @foreach($articles as $item)
            @if($loop->first)
                <section class="topnews imgscale">
                    <a href="/">
                        <img src="{{$item->cover??'/blog/images/h2.jpg'}}">
                        <span>{{$item->title}}</span>
                    </a>
                </section>
            @endif
        @endforeach
        <ul>
            @foreach($articles as $item)
                @if(!$loop->first)
                    <li>
                        <a href="{{route('blog.show',[$item->id])}}">
                            <i><img src="{{$item->cover??'/blog/images/text01.jpg'}}"></i>
                            <p>{{$item->title}}</p>
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
@endif