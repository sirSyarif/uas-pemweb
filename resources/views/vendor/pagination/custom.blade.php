<style>
    .pagination {
        display: flex;
        justify-content: center;
        margin: 20px 0;
    }

    .pagination a,
    .pagination span {
        margin: 0 5px;
        padding: 5px 10px;
        border-radius: 5px;
        background-color: #f7f7f7;
        color: #333;
        text-decoration: none;
    }

    .pagination a:hover {
        background-color: #eee;
    }

    .pagination .active {
        background-color: #337ab7;
        color: #fff;
        cursor: default;
    }

    .pagination .disabled {
        color: #ccc;
        cursor: not-allowed;
    }
</style>

<div class="pagination">
    @if ($paginator->onFirstPage())
        <span class="disabled">{{ __('pagination.previous') }}</span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}">{{ __('pagination.previous') }}</a>
    @endif

    @foreach ($elements as $element)
        @if (is_string($element))
            <span class="disabled">{{ $element }}</span>
        @endif

        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <span class="active">{{ $page }}</span>
                @else
                    <a href="{{ $url }}">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}">{{ __('pagination.next') }}</a>
    @else
        <span class="disabled">{{ __('pagination.next') }}</span>
    @endif
</div>
