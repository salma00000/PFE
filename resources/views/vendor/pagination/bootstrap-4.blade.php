    <div class="pagination p1">
        <ul>
            @if ($paginator->hasPages())
                @if (!$paginator->onFirstPage())
                    <a href = "javascript:void(0)" wire:click = "setPage('{{ $paginator->previousPageUrl() }}')"><li><</li></a>
                @endif
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <a href="javascript:void(0)" disabled><li>{{$element}}</li></a>
                    @endif
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <a class="is-active" href = "javascript: void(0)">
                                    <li>{{$page}}</li>
                                </a>
                            @else
                                <a href = "javascript:void(0)" wire:click = "setPage('{{ $url }}')"><li>{{$page}}</li></a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
                @if ($paginator->hasMorePages())
                    <a href = "javascript:void(0)" wire:click = "setPage('{{ $paginator->nextPageUrl() }}')"><li>></li></a>
                @endif
            @endif
        </ul>
    </div>
