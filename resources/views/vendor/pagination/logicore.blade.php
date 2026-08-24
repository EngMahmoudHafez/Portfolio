@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}"
         class="flex flex-col items-center justify-between gap-5 border-t border-line-soft pt-8 sm:flex-row">

        {{-- Result range --}}
        <p class="lc-meta order-2 sm:order-1">
            {!! __('Showing') !!}
            <span class="text-ink-muted">{{ $paginator->firstItem() }}</span>
            &ndash;
            <span class="text-ink-muted">{{ $paginator->lastItem() }}</span>
            {!! __('of') !!}
            <span class="text-ink-muted">{{ $paginator->total() }}</span>
        </p>

        <ul class="order-1 flex flex-wrap items-center justify-center gap-1.5 sm:order-2">
            {{-- Previous --}}
            <li>
                @if ($paginator->onFirstPage())
                    <span class="lc-page-link" aria-disabled="true" aria-label="Previous page">
                        <i class="fas fa-chevron-left text-[0.65rem]" aria-hidden="true"></i>
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="lc-page-link" aria-label="Previous page">
                        <i class="fas fa-chevron-left text-[0.65rem]" aria-hidden="true"></i>
                    </a>
                @endif
            </li>

            {{-- Page numbers --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li>
                        <span class="lc-page-link" aria-disabled="true">{{ $element }}</span>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        <li>
                            @if ($page == $paginator->currentPage())
                                <span class="lc-page-link" aria-current="page" aria-label="{{ __('Page :page', ['page' => $page]) }}">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="lc-page-link" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">{{ $page }}</a>
                            @endif
                        </li>
                    @endforeach
                @endif
            @endforeach

            {{-- Next --}}
            <li>
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="lc-page-link" aria-label="Next page">
                        <i class="fas fa-chevron-right text-[0.65rem]" aria-hidden="true"></i>
                    </a>
                @else
                    <span class="lc-page-link" aria-disabled="true" aria-label="Next page">
                        <i class="fas fa-chevron-right text-[0.65rem]" aria-hidden="true"></i>
                    </span>
                @endif
            </li>
        </ul>
    </nav>
@endif
