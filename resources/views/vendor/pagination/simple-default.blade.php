@if ($paginator->hasPages())
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
        <span class="arrows float-left mt-1 ti-angle-left rounded-left p-2" style="border-left: 1px solid #d0d4d8; border-left: 0.5px solid #d0d4d8;"></span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" class="arrows float-left mt-1 ti-angle-left rounded-left p-2" style="border-left: 1px solid #d0d4d8; border-left: 0.5px solid #d0d4d8;"></a>
    @endif

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="arrows float-right mt-1 ti-angle-right rounded-right p-2" style="border-right: 1px solid #d0d4d8; border-right: 0.5px solid #d0d4d8;"></a>
    @else
        <span class="arrows float-right mt-1 ti-angle-right rounded-right p-2" style="border-right: 1px solid #d0d4d8; border-right: 0.5px solid #d0d4d8;"></span>
    @endif
@endif
