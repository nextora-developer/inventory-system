@extends('layouts.admin')

@section('page-title', 'Stock Movement Report')

@section('content')
    <div class="rounded-3xl border border-slate-200 bg-white shadow-sm">
        <div class="border-b border-slate-200 p-6">
            <h2 class="text-lg font-bold text-slate-900">Stock Movement Report</h2>
            <p class="mt-1 text-sm text-slate-500">Track all stock in, stock out, and adjustments.</p>

            <form method="GET" action="{{ route('reports.stock-movement') }}"
                class="mt-6 grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-5">
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Type</label>
                    <select name="type" class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm">
                        <option value="">All Types</option>
                        <option value="in" {{ request('type') === 'in' ? 'selected' : '' }}>Stock In</option>
                        <option value="out" {{ request('type') === 'out' ? 'selected' : '' }}>Stock Out</option>
                        <option value="adjustment_plus" {{ request('type') === 'adjustment_plus' ? 'selected' : '' }}>Adjustment +</option>
                        <option value="adjustment_minus" {{ request('type') === 'adjustment_minus' ? 'selected' : '' }}>Adjustment -</option>
                    </select>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Product</label>
                    <select name="product_id" class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm">
                        <option value="">All Products</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" {{ (string) request('product_id') === (string) $product->id ? 'selected' : '' }}>
                                {{ $product->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Date From</label>
                    <input type="date" name="date_from" value="{{ request('date_from') }}"
                        class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm">
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Date To</label>
                    <input type="date" name="date_to" value="{{ request('date_to') }}"
                        class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm">
                </div>

                <div class="flex items-end gap-2">
                    <button type="submit"
                        class="w-full rounded-2xl bg-slate-900 px-4 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
                        Filter
                    </button>

                    <a href="{{ route('reports.stock-movement') }}"
                        class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-center text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Date</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Product</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Type</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Qty</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Supplier</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Reference</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.2em] text-slate-500">By</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse($transactions as $transaction)
                        <tr class="hover:bg-slate-50/80">
                            <td class="px-6 py-4 text-sm text-slate-500">
                                {{ $transaction->transaction_date?->format('d M Y') ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-semibold text-slate-900">{{ $transaction->product?->name ?? '-' }}</p>
                                <p class="mt-1 text-sm text-slate-500">{{ $transaction->product?->sku ?? '-' }}</p>
                            </td>
                            <td class="px-6 py-4">
                                @if($transaction->type === 'in')
                                    <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">Stock In</span>
                                @elseif($transaction->type === 'out')
                                    <span class="rounded-full bg-rose-100 px-3 py-1 text-xs font-semibold text-rose-700">Stock Out</span>
                                @elseif($transaction->type === 'adjustment_plus')
                                    <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">Adjustment +</span>
                                @else
                                    <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-700">Adjustment -</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm font-semibold text-slate-900">{{ $transaction->quantity }}</td>
                            <td class="px-6 py-4 text-sm text-slate-500">{{ $transaction->supplier?->name ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-slate-500">{{ $transaction->reference_no ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-slate-500">{{ $transaction->user?->name ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-10 text-center text-sm text-slate-500">
                                No stock movement found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($transactions->hasPages())
            <div class="border-t border-slate-200 p-6">
                {{ $transactions->links() }}
            </div>
        @endif
    </div>
@endsection