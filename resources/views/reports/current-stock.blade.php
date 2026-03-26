@extends('layouts.admin')

@section('page-title', 'Current Stock Report')

@section('content')
    <div class="rounded-3xl border border-slate-100 bg-white shadow-sm overflow-hidden">

        {{-- Header --}}
        <div class="border-b border-slate-100 p-6 bg-white">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

                <div>
                    <h2 class="text-xl font-bold text-slate-900">Inventory Overview</h2>
                    <p class="mt-1 text-sm text-slate-500">Real-time stock levels across all products.</p>
                </div>

                {{-- Search --}}
                <form method="GET" action="{{ route('reports.current-stock') }}" class="flex gap-2">
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm focus:border-[#8b5cf6] focus:ring-2 focus:ring-[#8b5cf6]/20 sm:w-72"
                        placeholder="Search product / SKU / barcode">

                    <button type="submit"
                        class="rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">
                        Search
                    </button>
                </form>

            </div>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-100">

                {{-- Head --}}
                <thead class="bg-slate-50/50">
                    <tr>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-400">Product</th>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-400">Category</th>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-400">SKU</th>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-400">Stock</th>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-400">Min</th>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-400">Status</th>
                    </tr>
                </thead>

                {{-- Body --}}
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse($products as $product)
                        <tr class="group transition-all hover:bg-slate-50/50">

                            {{-- Product --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">

                                    {{-- Icon --}}
                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-slate-500 group-hover:bg-indigo-50 group-hover:text-[#8b5cf6] transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M20 13V7a2 2 0 00-2-2H6a2 2 0 00-2 2v6m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5" />
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
                                <span class="inline-flex items-center rounded-md bg-slate-100 px-2 py-1 text-xs font-medium text-slate-600">
                                    {{ $product->category?->name ?? 'Uncategorized' }}
                                </span>
                            </td>

                            {{-- SKU --}}
                            <td class="px-6 py-4">
                                <span class="text-xs font-mono bg-slate-100 text-slate-600 px-2 py-1 rounded-md">
                                    {{ $product->sku }}
                                </span>
                            </td>

                            {{-- Stock --}}
                            <td class="px-6 py-4">
                                <p class="font-semibold {{ $product->stock_quantity <= $product->minimum_stock ? 'text-rose-600' : 'text-slate-900' }}">
                                    {{ $product->stock_quantity }} {{ $product->unit }}
                                </p>
                            </td>

                            {{-- Min --}}
                            <td class="px-6 py-4 text-sm text-slate-500">
                                {{ $product->minimum_stock }}
                            </td>

                            {{-- Status --}}
                            <td class="px-6 py-4">
                                @if($product->stock_quantity <= $product->minimum_stock)
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-rose-50 px-3 py-1 text-[11px] font-bold text-rose-600 ring-1 ring-inset ring-rose-500/20">
                                        Low Stock
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1 text-[11px] font-bold text-emerald-700 ring-1 ring-inset ring-emerald-600/20">
                                        Healthy
                                    </span>
                                @endif
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-20 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="h-16 w-16 rounded-full bg-slate-50 flex items-center justify-center text-slate-300 mb-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3 7h18M3 12h18M3 17h18" />
                                        </svg>
                                    </div>
                                    <p class="text-slate-500 font-medium">No products found.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        {{-- Pagination --}}
        @if ($products->hasPages())
            <div class="border-t border-slate-100 bg-slate-50/30 px-6 py-4">
                {{ $products->links() }}
            </div>
        @endif

    </div>
@endsection