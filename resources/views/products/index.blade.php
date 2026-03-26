@extends('layouts.admin')

@section('page-title', 'Products')

@section('content')
    <div class="rounded-3xl border border-slate-200 bg-white shadow-sm">
        <div class="flex flex-col gap-4 border-b border-slate-200 p-6 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h2 class="text-lg font-bold text-slate-900">Product List</h2>
                <p class="mt-1 text-sm text-slate-500">Manage all inventory products here.</p>
            </div>

            <div class="flex flex-col gap-3 sm:flex-row">
                <form method="GET" action="{{ route('products.index') }}" class="flex gap-2">
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm sm:w-64"
                        placeholder="Search product, SKU, barcode...">
                    <button type="submit"
                        class="rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                        Search
                    </button>
                </form>

                <a href="{{ route('products.create') }}"
                    class="inline-flex items-center rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
                    + Add Product
                </a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.2em] text-slate-500">#</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Product
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Category
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Stock
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Prices
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Status
                        </th>
                        <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Action
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse ($products as $product)
                        <tr class="hover:bg-slate-50/80">
                            <td class="px-6 py-4 text-sm text-slate-500">
                                {{ $loop->iteration + ($products->currentPage() - 1) * $products->perPage() }}
                            </td>

                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-semibold text-slate-900">{{ $product->name }}</p>
                                    <p class="mt-1 text-sm text-slate-500">
                                        SKU:
                                        {{ $product->sku }}{{ $product->barcode ? ' • Barcode: ' . $product->barcode : '' }}
                                    </p>
                                </div>
                            </td>

                            <td class="px-6 py-4 text-sm text-slate-600">
                                {{ $product->category?->name ?? 'Uncategorized' }}
                            </td>

                            <td class="px-6 py-4">
                                <div>
                                    <p
                                        class="font-semibold {{ $product->stock_quantity <= $product->minimum_stock ? 'text-rose-600' : 'text-slate-900' }}">
                                        {{ $product->stock_quantity }} {{ $product->unit }}
                                    </p>
                                    <p class="mt-1 text-xs text-slate-500">
                                        Min: {{ $product->minimum_stock }}
                                    </p>
                                </div>
                            </td>

                            <td class="px-6 py-4 text-sm text-slate-600">
                                <p>Cost: RM {{ number_format($product->cost_price, 2) }}</p>
                                <p class="mt-1">Sell: RM {{ number_format($product->selling_price, 2) }}</p>
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex flex-col gap-2">
                                    @if ($product->is_active)
                                        <span
                                            class="w-fit rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">
                                            Active
                                        </span>
                                    @else
                                        <span
                                            class="w-fit rounded-full bg-slate-200 px-3 py-1 text-xs font-semibold text-slate-700">
                                            Inactive
                                        </span>
                                    @endif

                                    @if ($product->stock_quantity <= $product->minimum_stock)
                                        <span
                                            class="w-fit rounded-full bg-rose-100 px-3 py-1 text-xs font-semibold text-rose-700">
                                            Low Stock
                                        </span>
                                    @endif
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('products.edit', $product) }}"
                                        class="rounded-xl border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                                        Edit
                                    </a>

                                    <form action="{{ route('products.destroy', $product) }}" method="POST"
                                        onsubmit="return confirm('Delete this product?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="rounded-xl border border-rose-200 bg-rose-50 px-4 py-2 text-sm font-semibold text-rose-600 transition hover:bg-rose-100">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-10 text-center text-sm text-slate-500">
                                No products found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($products->hasPages())
            <div class="border-t border-slate-200 p-6">
                {{ $products->links() }}
            </div>
        @endif
    </div>
@endsection
