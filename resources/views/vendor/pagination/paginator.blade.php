@if ($paginator->hasPages())
    <nav>
        <ul class="container__paginator">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
            @else
            <a href="{{ $paginator->previousPageUrl() }}"><li><i class="fa-solid fa-caret-left" id="paginator"></i></li></a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active"><span>{{ $page }}</span></li>
                        @else
                            <a href="{{ $url }}"><li>{{ $page }}</li></a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"><li><i class="fa-solid fa-caret-right" id="paginator"></i></li></a>
            @endif
        </ul>
    </nav>
@endif
