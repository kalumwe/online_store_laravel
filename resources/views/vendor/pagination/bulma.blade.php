@if ($paginator->hasPages())
    <nav class="pagination is-centered" role="navigation" aria-label="pagination">
        <ul class="pagination-list">
            @if ($paginator->onFirstPage())
                <li><span class="pagination-previous" disabled>Previous</span></li>
            @else
                <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="pagination-previous">Previous</a></li>
            @endif

            @foreach ($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
                <li>
                    <a href="{{ $url }}" class="pagination-link {{ $page == $paginator->currentPage() ? 'is-current' : '' }}">
                        {{ $page }}
                    </a>
                </li>
            @endforeach

            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}" rel="next" class="pagination-next">Next</a></li>
            @else
                <li><span class="pagination-next" disabled>Next</span></li>
            @endif
        </ul>
    </nav>
@endif
