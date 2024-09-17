@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between gap-4">
        {{-- Previous Page Link --}}
        @if (!$paginator->onFirstPage())
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="bg-primary text-white text-sm py-2 px-3 rounded-lg">
                « Précédent
            </a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="bg-primary text-white text-sm py-2 px-3 rounded-lg">
                Suivant »
            </a>
        @endif
    </nav>
@endif
