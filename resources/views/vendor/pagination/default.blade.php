<ul class="pagination pagination-sm">
    <li class="{{ $paginator->onFirstPage() ? 'isabled' : '' }}">
        <a href="{{ $paginator->previousPageUrl() }}">Previous</a>
    </li>

    <li class="{{ $paginator->hasMorePages() ? '' : 'isabled' }}">
        <a href="{{ $paginator->nextPageUrl() }}">Next</a>
    </li>
</ul>
