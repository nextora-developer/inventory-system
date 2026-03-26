@extends('layouts.admin')

@section('page-title', 'Stock Movement Report')

@section('content')
    <div class="rounded-3xl border border-slate-100 bg-white shadow-sm overflow-hidden">

        {{-- Header --}}
        <div class="border-b border-slate-100 p-6 bg-white">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

                <div>
                    <h2 class="text-xl font-bold text-slate-900">Stock Movement Analytics</h2>
                    <p class="mt-1 text-sm text-slate-500">Monitor all inventory inflow, outflow, and adjustments.</p>
                </div>

            </div>

            {{-- Filters --}}
            <form method="GET" action="{{ route('reports.stock-movement') }}"
                class="mt-6 grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-5">

                {{-- Type --}}
                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-slate-400">Type</label>
                    <select name="type"
                        class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm focus:border-[#8b5cf6] focus:ring-2 focus:ring-[#8b5cf6]/20">
                        <option value="">All Types</option>
                        <option value="in" {{ request('type') === 'in' ? 'selected' : '' }}>Stock In</option>
                        <option value="out" {{ request('type') === 'out' ? 'selected' : '' }}>Stock Out</option>
                        <option value="adjustment_plus" {{ request('type') === 'adjustment_plus' ? 'selected' : '' }}>Adjustment +</option>
                        <option value="adjustment_minus" {{ request('type') === 'adjustment_minus' ? 'selected' : '' }}>Adjustment -</option>
                    </select>
                </div>

                {{-- Product --}}
                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-slate-400">Product</label>
                    <select name="product_id"
                        class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm focus:border-[#8b5cf6] focus:ring-2 focus:ring-[#8b5cf6]/20">
                        <option value="">All Products</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" {{ (string) request('product_id') === (string) $product->id ? 'selected' : '' }}>
                                {{ $product->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Date --}}
                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-slate-400">From</label>
                    <input type="date" name="date_from" value="{{ request('date_from') }}"
                        class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm focus:border-[#8b5cf6] focus:ring-2 focus:ring-[#8b5cf6]/20">
                </div>

                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-slate-400">To</label>
                    <input type="date" name="date_to" value="{{ request('date_to') }}"
                        class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm focus:border-[#8b5cf6] focus:ring-2 focus:ring-[#8b5cf6]/20">
                </div>

                {{-- Actions --}}
                <div class="flex items-end gap-2">
                    <button type="submit"
                        class="w-full rounded-2xl bg-[#8b5cf6] px-4 py-3 text-sm font-bold text-white transition hover:bg-[#7c3aed] hover:shadow-lg">
                        Apply
                    </button>

                    <a href="{{ route('reports.stock-movement') }}"
                        class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-center text-sm font-semibold text-slate-700 hover:bg-slate-50">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-100">

                {{-- Head --}}
                <thead class="bg-slate-50/50">
                    <tr>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-400">Date</th>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-400">Product</th>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-400">Type</th>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-400">Qty</th>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-400">Supplier</th>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-400">Reference</th>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-400">By</th>
                    </tr>
                </thead>

                {{-- Body --}}
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse($transactions as $transaction)
                        <tr class="group transition-all hover:bg-slate-50/50">

                            {{-- Date --}}
                            <td class="px-6 py-4 text-sm text-slate-500">
                                {{ $transaction->transaction_date?->format('d M, Y') ?? '-' }}
                                <p class="text-xs text-slate-400">
                                    {{ $transaction->transaction_date?->format('H:i') ?? '' }}
                                </p>
                            </td>

                            {{-- Product --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-100 text-slate-500 group-hover:bg-indigo-50 group-hover:text-[#8b5cf6] transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M20 13V7a2 2 0 00-2-2H6a2 2 0 00-2 2v6" />
                                        </svg>
                                    </div>

                                    <div>
                                        <p class="font-bold text-slate-900">{{ $transaction->product?->name ?? '-' }}</p>
                                        <p class="text-xs text-slate-400">{{ $transaction->product?->sku ?? '-' }}</p>
                                    </div>
                                </div>
                            </td>

                            {{-- Type --}}
                            <td class="px-6 py-4">
                                @if($transaction->type === 'in')
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1 text-[11px] font-bold text-emerald-700 ring-1 ring-emerald-600/20">
                                        Stock In
                                    </span>
                                @elseif($transaction->type === 'out')
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-rose-50 px-3 py-1 text-[11px] font-bold text-rose-600 ring-1 ring-rose-500/20">
                                        Stock Out
                                    </span>
                                @elseif($transaction->type === 'adjustment_plus')
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-blue-50 px-3 py-1 text-[11px] font-bold text-blue-600 ring-1 ring-blue-500/20">
                                        Adjustment +
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 px-3 py-1 text-[11px] font-bold text-amber-600 ring-1 ring-amber-500/20">
                                        Adjustment -
                                    </span>
                                @endif
                            </td>

                            {{-- Qty --}}
                            <td class="px-6 py-4 text-sm font-semibold {{ $transaction->type === 'out' ? 'text-rose-600' : 'text-slate-900' }}">
                                {{ $transaction->quantity }}
                            </td>

                            {{-- Supplier --}}
                            <td class="px-6 py-4 text-sm text-slate-500">
                                {{ $transaction->supplier?->name ?? '-' }}
                            </td>

                            {{-- Ref --}}
                            <td class="px-6 py-4 text-sm text-slate-500 font-mono">
                                {{ $transaction->reference_no ?? '-' }}
                            </td>

                            {{-- User --}}
                            <td class="px-6 py-4 text-sm text-slate-600 font-medium">
                                {{ $transaction->user?->name ?? '-' }}
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-20 text-center">
                                <p class="text-slate-500 font-medium">No stock movement data found.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        {{-- Pagination --}}
        @if ($transactions->hasPages())
            <div class="border-t border-slate-100 bg-slate-50/30 px-6 py-4">
                {{ $transactions->links() }}
            </div>
        @endif

    </div>
@endsection