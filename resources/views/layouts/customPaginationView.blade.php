@if ($paginator->hasPages())
    <nav class="pagination container-fluid" style="background: var(--color-primary) !important;">
        @if ($paginator->onFirstPage())
            <a class="nav-link" disabled>Previa</a>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="nav-link">Previa</a>
        @endif
        @if ($paginator->hasMorePages())
            <a class="nav-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Siguiente</a>
        @else
            <a class="nav-link" disabled>Siguiente</a>
        @endif
        <ul class="pagination-list list-unstyled">
            @foreach ($elements as $element)
                <div class="col-auto">
                    @if (is_string($element))
                        <li><span class="pagination-ellipsis"><span>{{ $element }}</span></span></li>
                    @endif
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li><a class="pagination-link is-current nav-link">{{ $page }}</a></li>
                            @else
                                <li><a href="{{ $url }}" class="nav-link">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                </div>
            @endforeach
        </ul>
    </nav>
@endif
