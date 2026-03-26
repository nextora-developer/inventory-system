@extends('layouts.admin')

@section('page-title', 'Low Stock Report')

@section('content')
    <div class="rounded-3xl border border-slate-200 bg-white shadow-sm">
        <div class="border-b border-slate-200 p-6">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <h2 class="text-lg font-bold text-slate-900">Low Stock Report</h2>
                    <p class="mt-1 text-sm text-slate-500">Products that need urgent restock.</p>
                </div>

                <form method="GET" action="{{ route('reports.low-stock') }}" class="flex gap-2">
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm sm:w-72"
                        placeholder="Search product / SKU">
                    <button type="submit"
                        class="rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                        Search
                    </button>
                </form>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Product</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Category</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.2em] text-slate-500">SKU</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Current Stock</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Minimum</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Location</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse($products as $product)
                        <tr class="hover:bg-slate-50/80">
                            <td class="px-6 py-4">
                                <p class="font-semibold text-slate-900">{{ $product->name }}</p>
                                <p class="mt-1 text-sm text-slate-500">{{ $product->brand ?: 'No brand' }}</p>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600">
                                {{ $product->category?->name ?? 'Uncategorized' }}
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600">{{ $product->sku }}</td>
                            <td class="px-6 py-4">
                                <span class="rounded-full bg-rose-100 px-3 py-1 text-xs font-semibold text-rose-700">
                                    {{ $product->stock_quantity }} {{ $product->unit }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600">{{ $product->minimum_stock }}</td>
                            <td class="px-6 py-4 text-sm text-slate-600">{{ $product->location ?: '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-sm text-slate-500">
                                No low stock products found.
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