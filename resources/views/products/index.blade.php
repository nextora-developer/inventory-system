@extends('layouts.admin')

@section('page-title', 'Products')

@section('content')
    <div class="overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-sm">

        {{-- Header --}}
        <div
            class="flex flex-col gap-4 border-b border-slate-100 bg-white p-4 md:p-6 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h2 class="text-lg font-bold text-slate-900 md:text-xl">Product Inventory</h2>
                <p class="mt-1 text-xs text-slate-500 md:text-sm">Manage and monitor all inventory assets.</p>
            </div>

            <div class="flex flex-col gap-3 sm:flex-row">
                {{-- Search --}}
                <form method="GET" action="{{ route('products.index') }}" class="flex gap-2">
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm focus:border-[#8b5cf6] focus:ring-2 focus:ring-[#8b5cf6]/20 sm:w-64"
                        placeholder="Search product, SKU, barcode...">

                    @if (request('search'))
                        <a href="{{ route('products.index') }}"
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

                {{-- Add --}}
                <a href="{{ route('products.create') }}"
                    class="group inline-flex items-center justify-center gap-2 rounded-2xl bg-[#8b5cf6] px-5 py-3 text-sm font-bold text-white transition-all hover:bg-[#7c3aed] hover:shadow-lg hover:shadow-indigo-100 active:scale-95 md:px-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform group-hover:rotate-90"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Create Product
                </a>
            </div>
        </div>

        {{-- Mobile Card List --}}
        <div class="block md:hidden">
            @forelse ($products as $product)
                <div class="border-b border-slate-100 p-4 last:border-b-0">
                    <div class="flex items-start gap-3">
                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-slate-500">
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
                                        SKU: {{ $product->sku }}
                                        @if ($product->barcode)
                                            • {{ $product->barcode }}
                                        @endif
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

                                @if ($product->is_active)
                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-1 text-[11px] font-bold text-emerald-700 ring-1 ring-inset ring-emerald-600/20">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                        Active
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-2.5 py-1 text-[11px] font-bold text-slate-600 ring-1 ring-inset ring-slate-400/20">
                                        <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>
                                        Disabled
                                    </span>
                                @endif

                                @if ($product->stock_quantity <= $product->minimum_stock)
                                    <span
                                        class="inline-flex items-center rounded-full bg-rose-50 px-2.5 py-1 text-[11px] font-bold text-rose-600 ring-1 ring-inset ring-rose-500/20">
                                        Low Stock
                                    </span>
                                @endif
                            </div>

                            <div class="mt-3 grid grid-cols-2 gap-3 text-xs">
                                <div class="rounded-2xl bg-slate-50 px-3 py-2">
                                    <p class="font-bold uppercase tracking-wide text-slate-400">Stock</p>
                                    <p class="mt-1 font-semibold text-slate-700">
                                        {{ $product->stock_quantity }} {{ $product->unit }}
                                    </p>
                                    <p class="mt-1 text-slate-400">Min: {{ $product->minimum_stock }}</p>
                                </div>

                                <div class="rounded-2xl bg-slate-50 px-3 py-2">
                                    <p class="font-bold uppercase tracking-wide text-slate-400">Pricing</p>
                                    <p class="mt-1 text-slate-500">Cost: <span class="font-semibold text-slate-800">RM
                                            {{ number_format($product->cost_price, 2) }}</span></p>
                                    <p class="mt-1 text-slate-500">Sell: <span class="font-semibold text-[#8b5cf6]">RM
                                            {{ number_format($product->selling_price, 2) }}</span></p>
                                </div>
                            </div>

                            <div class="mt-3 flex items-center justify-end gap-2">
                                <a href="{{ route('products.edit', $product) }}"
                                    class="rounded-xl bg-indigo-50 p-2 text-[#8b5cf6] transition-all hover:bg-indigo-100"
                                    title="Edit Product">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>

                                <form action="{{ route('products.destroy', $product) }}" method="POST"
                                    onsubmit="return confirm('Delete this product?')" class="inline">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="rounded-xl bg-rose-50 p-2 text-rose-600 transition-all hover:bg-rose-100"
                                        title="Delete Product">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="px-6 py-16 text-center">
                    <p class="font-medium text-slate-500">No products available.</p>
                    <a href="{{ route('products.create') }}"
                        class="mt-2 inline-block text-sm font-bold text-[#8b5cf6] hover:underline">
                        Create first product →
                    </a>
                </div>
            @endforelse
        </div>

        {{-- Desktop Table --}}
        <div class="hidden overflow-x-auto md:block">
            <table class="min-w-full divide-y divide-slate-100">
                <thead class="bg-slate-50/50">
                    <tr>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-400">No
                        </th>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-400">
                            Product</th>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-400">
                            Category</th>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-400">
                            Stock</th>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-400">
                            Pricing</th>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-400">
                            Status</th>
                        <th class="px-6 py-4 text-right text-[11px] font-bold uppercase tracking-[0.15em] text-slate-400">
                            Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse ($products as $product)
                        <tr class="group transition-all hover:bg-slate-50/50">
                            <td class="px-6 py-4 text-sm font-mono text-slate-400">
                                #{{ str_pad($loop->iteration + ($products->currentPage() - 1) * $products->perPage(), 2, '0', STR_PAD_LEFT) }}
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-slate-500 transition-colors group-hover:bg-indigo-50 group-hover:text-[#8b5cf6]">
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                        </svg>
                                    </div>

                                    <div>
                                        <p class="font-bold text-slate-900">{{ $product->name }}</p>
                                        <p class="mt-0.5 text-xs text-slate-400">
                                            SKU: {{ $product->sku }}
                                            @if ($product->barcode)
                                                • Barcode: {{ $product->barcode }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 text-sm text-slate-600">
                                <span
                                    class="inline-flex items-center rounded-md bg-slate-100 px-2 py-1 text-xs font-medium text-slate-600">
                                    {{ $product->category?->name ?? 'Uncategorized' }}
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                <div>
                                    <p
                                        class="font-semibold {{ $product->stock_quantity <= $product->minimum_stock ? 'text-rose-600' : 'text-slate-900' }}">
                                        {{ $product->stock_quantity }} {{ $product->unit }}
                                    </p>
                                    <p class="mt-0.5 text-xs text-slate-400">
                                        Min: {{ $product->minimum_stock }}
                                    </p>
                                </div>
                            </td>

                            <td class="px-6 py-4 text-sm">
                                <p class="text-slate-500">Cost</p>
                                <p class="font-semibold text-slate-900">RM {{ number_format($product->cost_price, 2) }}
                                </p>

                                <p class="mt-1 text-slate-500">Sell</p>
                                <p class="font-semibold text-[#8b5cf6]">RM {{ number_format($product->selling_price, 2) }}
                                </p>
                            </td>

                            <td class="px-6 py-4">
                                @if ($product->is_active)
                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1 text-[11px] font-bold text-emerald-700 ring-1 ring-inset ring-emerald-600/20">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                        Active
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-3 py-1 text-[11px] font-bold text-slate-600 ring-1 ring-inset ring-slate-400/20">
                                        <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>
                                        Disabled
                                    </span>
                                @endif

                                @if ($product->stock_quantity <= $product->minimum_stock)
                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-full bg-rose-50 px-3 py-1 text-[11px] font-bold text-rose-600 ring-1 ring-inset ring-rose-500/20">
                                        Low Stock
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('products.edit', $product) }}"
                                        class="rounded-lg p-2 text-slate-400 transition-all hover:bg-indigo-50 hover:text-[#8b5cf6]"
                                        title="Edit Product">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>

                                    <form action="{{ route('products.destroy', $product) }}" method="POST"
                                        onsubmit="return confirm('Delete this product?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="rounded-lg p-2 text-slate-400 transition-all hover:bg-rose-50 hover:text-rose-600"
                                            title="Delete Product">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-20 text-center">
                                <p class="font-medium text-slate-500">No products available.</p>
                                <a href="{{ route('products.create') }}"
                                    class="mt-2 inline-block text-sm font-bold text-[#8b5cf6] hover:underline">
                                    Create first product →
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{--
        @if ($products->hasPages())
            <div class="border-t border-slate-100 bg-slate-50/30 px-4 py-4 md:px-6">
                {{ $products->links() }}
            </div>
        @endif--}}

        {{-- Pagination --}}
        @if ($products->hasPages())
            <div class="border-t border-slate-100 bg-slate-50/30 px-4 py-4 md:px-6">
                <x-pagination :paginator="$products" />
            </div>
        @endif

    </div>
@endsection
