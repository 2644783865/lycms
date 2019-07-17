@if ($paginator->hasPages())
    <ul>
        @if ($paginator->total())
            <li>
                <a href="{{ $paginator->url(1) }}">首页</a>
            </li>
        @endif
        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="thisclass"><span>{{ $page }}</span></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach
        @if ($paginator->total())
            <li>
                <a href="{{ $paginator->url($paginator->lastPage()) }}">末页</a>
            </li>
        @endif
    </ul>
@endif
