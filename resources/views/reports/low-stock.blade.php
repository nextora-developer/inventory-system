@extends('layouts.admin')

@section('page-title', 'Low Stock Report')

@section('content')
    <div class="overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-sm">

        {{-- Header --}}
        <div
            class="flex flex-col gap-4 border-b border-slate-100 bg-white p-4 md:p-6 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h2 class="text-lg font-bold text-slate-900 md:text-xl">Low Stock Alerts</h2>
                <p class="mt-1 text-xs text-slate-500 md:text-sm">Products that require immediate restocking attention.</p>
            </div>

            {{-- Search --}}
            <form method="GET" action="{{ route('reports.low-stock') }}" class="flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}"
                    class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm focus:border-[#8b5cf6] focus:ring-2 focus:ring-[#8b5cf6]/20 sm:w-72"
                    placeholder="Search product / SKU">

                @if (request('search'))
                    <a href="{{ route('reports.low-stock') }}"
                        class="rounded-2xl bg-rose-500 px-4 py-3 text-sm font-semibold text-white transition hover:bg-rose-600">
                        Clear
                    </a>
                @else
                    <button type="submit"
                        class="rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                        Search
                    </button>
                @endif
            </form>
        </div>

        {{-- Mobile Card List --}}
        <div class="block md:hidden">
            @forelse ($products as $product)
                <div class="border-b border-slate-100 p-4 last:border-b-0">
                    <div class="flex items-start gap-3">
                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-rose-50 text-rose-500">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>

                        <div class="min-w-0 flex-1">
                            <div class="flex items-start justify-between gap-3">
                                <div class="min-w-0">
                                    <p class="text-sm font-bold text-slate-900">{{ $product->name }}</p>
                                    <p class="mt-1 text-xs text-slate-400">
                                        {{ $product->brand ?: 'No brand' }}
                                    </p>
                                    <p class="mt-1 text-xs text-slate-400">
                                        SKU: {{ $product->sku }}
                                    </p>
                                </div>

                                <div class="shrink-0 text-xs font-mono text-slate-400">
                                    #{{ str_pad($loop->iteration + ($products->currentPage() - 1) * $products->perPage(), 2, '0', STR_PAD_LEFT) }}
                                </div>
                            </div>

                            <div class="mt-3 flex flex-wrap items-center gap-2">
                                <span
                                    class="inline-flex items-center rounded-md bg-slate-100 px-2 py-1 text-[11px] font-medium text-slate-600">
                                    {{ $product->category?->name ?? 'Uncategorized' }}
                                </span>

                                <span
                                    class="inline-flex items-center rounded-full bg-rose-50 px-2.5 py-1 text-[11px] font-bold text-rose-600 ring-1 ring-inset ring-rose-500/20">
                                    Low Stock
                                </span>
                            </div>

                            <div class="mt-3 grid grid-cols-2 gap-3 text-xs">
                                <div class="rounded-2xl bg-slate-50 px-3 py-2">
                                    <p class="font-bold uppercase tracking-wide text-slate-400">Stock</p>
                                    <p class="mt-1 font-semibold text-rose-600">
                                        {{ $product->stock_quantity }} {{ $product->unit }}
                                    </p>
                                    <p class="mt-1 text-slate-400">Min: {{ $product->minimum_stock }}</p>
                                </div>

                                <div class="rounded-2xl bg-slate-50 px-3 py-2">
                                    <p class="font-bold uppercase tracking-wide text-slate-400">Location</p>
                                    <p class="mt-1 font-semibold text-slate-700">
                                        {{ $product->location ?: '-' }}
                                    </p>
                                    <p class="mt-1 text-slate-400">
                                        {{ $product->category?->name ?? 'Uncategorized' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="px-6 py-16 text-center">
                    <p class="font-medium text-slate-500">No low stock products 🎉</p>
                </div>
            @endforelse
        </div>

        {{-- Desktop Table --}}
        <div class="hidden overflow-x-auto md:block">
            <table class="min-w-full divide-y divide-slate-100">

                {{-- Head --}}
                <thead class="bg-slate-50/50">
                    <tr>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-400">
                            Product</th>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-400">
                            Category</th>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-400">SKU
                        </th>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-400">
                            Stock</th>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-400">
                            Minimum</th>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-400">
                            Location</th>
                    </tr>
                </thead>

                {{-- Body --}}
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse($products as $product)
                        <tr class="group transition-all hover:bg-rose-50/40">

                            {{-- Product --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">

                                    {{-- Icon --}}
                                    <div
                                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-rose-50 text-rose-500 transition group-hover:bg-rose-100">

                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                        </svg>
                                    </div>

                                    <div>
                                        <p class="font-bold text-slate-900">{{ $product->name }}</p>
                                        <p class="mt-0.5 text-xs text-slate-400">
                                            {{ $product->brand ?: 'No brand' }}
                                        </p>
                                    </div>
                                </div>
                            </td>

                            {{-- Category --}}
                            <td class="px-6 py-4 text-sm text-slate-600">
                                <span
                                    class="inline-flex items-center rounded-md bg-slate-100 px-2 py-1 text-xs font-medium text-slate-600">
                                    {{ $product->category?->name ?? 'Uncategorized' }}
                                </span>
                            </td>

                            {{-- SKU --}}
                            <td class="px-6 py-4">
                                <span class="rounded-md bg-slate-100 px-2 py-1 text-xs font-mono text-slate-600">
                                    {{ $product->sku }}
                                </span>
                            </td>

                            {{-- Stock --}}
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center gap-1.5 rounded-full bg-rose-50 px-3 py-1 text-[11px] font-bold text-rose-600 ring-1 ring-inset ring-rose-500/20">
                                    {{ $product->stock_quantity }} {{ $product->unit }}
                                </span>
                            </td>

                            {{-- Min --}}
                            <td class="px-6 py-4 text-sm text-slate-500">
                                {{ $product->minimum_stock }}
                            </td>

                            {{-- Location --}}
                            <td class="px-6 py-4 text-sm text-slate-600">
                                {{ $product->location ?: '-' }}
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-20 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div
                                        class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-slate-50 text-slate-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3 7h18M3 12h18M3 17h18" />
                                        </svg>
                                    </div>
                                    <p class="font-medium text-slate-500">No low stock products 🎉</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        {{-- Pagination --}}
        @if ($products->hasPages())
            <div class="border-t border-slate-100 bg-slate-50/30 px-4 py-4 md:px-6">
                {{ $products->links() }}
            </div>
        @endif

    </div>
@endsection
