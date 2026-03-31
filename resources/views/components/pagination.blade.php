@if ($paginator->hasPages())
    <div class="flex justify-center">

        <div class="flex items-center gap-2">

            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <span class="px-4 py-2 text-sm text-slate-300 bg-slate-100 rounded-xl cursor-not-allowed">
                    Previous
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                   class="px-4 py-2 text-sm text-slate-600 bg-white border border-slate-200 rounded-xl hover:bg-violet-50 hover:text-violet-600 transition">
                    Previous
                </a>
            @endif

            {{-- Pages --}}
            @php
                $start = max($paginator->currentPage() - 2, 1);
                $end = min($paginator->currentPage() + 2, $paginator->lastPage());
            @endphp

            @for ($page = $start; $page <= $end; $page++)
                @if ($page == $paginator->currentPage())
                    <span class="px-4 py-2 text-sm font-semibold text-white bg-violet-600 rounded-xl shadow">
                        {{ $page }}
                    </span>
                @else
                    <a href="{{ $paginator->url($page) }}"
                       class="px-4 py-2 text-sm text-slate-600 bg-white border border-slate-200 rounded-xl hover:bg-violet-50 hover:text-violet-600 transition">
                        {{ $page }}
                    </a>
                @endif
            @endfor

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                   class="px-4 py-2 text-sm text-slate-600 bg-white border border-slate-200 rounded-xl hover:bg-violet-50 hover:text-violet-600 transition">
                    Next
                </a>
            @else
                <span class="px-4 py-2 text-sm text-slate-300 bg-slate-100 rounded-xl cursor-not-allowed">
                    Next
                </span>
            @endif

        </div>

    </div>
@endif