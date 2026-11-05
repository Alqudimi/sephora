@if (isset($paginator) && $paginator->hasPages())
    <nav aria-label="Pagination" class="mt-6 flex flex-wrap items-center justify-center gap-1.5">
        @if ($paginator->onFirstPage())
            <span class="h-10 px-3 flex items-center border border-outline-variant text-outline font-body-sm text-body-sm" aria-disabled="true">
                <span class="material-symbols-outlined text-[18px] mr-1">chevron_left</span> Previous
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="h-10 px-3 flex items-center border border-outline-variant text-primary font-body-sm text-body-sm hover:border-primary transition-colors">
                <span class="material-symbols-outlined text-[18px] mr-1">chevron_left</span> Previous
            </a>
        @endif

        @foreach ($paginator->getUrlRange(max(1, $paginator->currentPage() - 2), min($paginator->lastPage(), $paginator->currentPage() + 2)) as $page => $url)
            @if ($page === $paginator->currentPage())
                <span aria-current="page" class="h-10 w-10 flex items-center justify-center bg-primary text-on-primary border border-primary font-body-sm text-body-sm font-bold">{{ $page }}</span>
            @else
                <a href="{{ $url }}" class="h-10 w-10 flex items-center justify-center border border-outline-variant text-primary font-body-sm text-body-sm hover:border-primary transition-colors">{{ $page }}</a>
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="h-10 px-3 flex items-center border border-outline-variant text-primary font-body-sm text-body-sm hover:border-primary transition-colors">
                Next <span class="material-symbols-outlined text-[18px] ml-1">chevron_right</span>
            </a>
        @else
            <span class="h-10 px-3 flex items-center border border-outline-variant text-outline font-body-sm text-body-sm" aria-disabled="true">
                Next <span class="material-symbols-outlined text-[18px] ml-1">chevron_right</span>
            </span>
        @endif
    </nav>
@endif
