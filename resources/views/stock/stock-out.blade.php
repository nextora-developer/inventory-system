@extends('layouts.admin')

@section('page-title', 'Stock Out')

@section('content')
<div class="grid grid-cols-1 gap-6 xl:grid-cols-3">

    {{-- LEFT: FORM --}}
    <div class="xl:col-span-1">

        <div class="overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-xl shadow-slate-200/50">

            {{-- Gradient --}}
            <div class="h-2 bg-gradient-to-r from-rose-500 via-pink-500 to-red-500"></div>

            <div class="p-6">

                <div class="mb-8">
                    <h2 class="text-xl font-black text-slate-900">Stock Out Entry</h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Remove items from inventory (sales, usage, or damage).
                    </p>
                </div>

                <form action="{{ route('stock.out.store') }}" method="POST" class="space-y-6">
                    @csrf

                    {{-- Product --}}
                    <div class="group">
                        <label class="mb-2 ml-1 text-xs font-bold uppercase tracking-widest text-slate-500">
                            Product
                        </label>
                        <select name="product_id"
                            class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 px-4 py-3.5 text-sm focus:border-rose-500 focus:bg-white focus:ring-4 focus:ring-rose-500/10">
                            <option value="">Select product</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}"
                                    {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                    {{ $product->name }} (Stock: {{ $product->stock_quantity }} {{ $product->unit }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Quantity --}}
                    <div class="group">
                        <label class="mb-2 ml-1 text-xs font-bold uppercase tracking-widest text-slate-500">
                            Quantity
                        </label>
                        <input type="number" name="quantity"
                            value="{{ old('quantity') }}"
                            placeholder="e.g. 10"
                            class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 px-4 py-3.5 text-sm focus:border-rose-500 focus:bg-white focus:ring-4 focus:ring-rose-500/10">
                    </div>

                    {{-- Reference --}}
                    <div class="group">
                        <label class="mb-2 ml-1 text-xs font-bold uppercase tracking-widest text-slate-500">
                            Reference No
                        </label>
                        <input type="text" name="reference_no"
                            value="{{ old('reference_no') }}"
                            placeholder="e.g. SALES-001 / REQ-102"
                            class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 px-4 py-3.5 text-sm focus:border-rose-500 focus:bg-white focus:ring-4 focus:ring-rose-500/10">
                    </div>

                    {{-- Date --}}
                    <div class="group">
                        <label class="mb-2 ml-1 text-xs font-bold uppercase tracking-widest text-slate-500">
                            Transaction Date
                        </label>
                        <input type="date" name="transaction_date"
                            value="{{ old('transaction_date', now()->format('Y-m-d')) }}"
                            class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 px-4 py-3.5 text-sm">
                    </div>

                    {{-- Remark --}}
                    <div class="group">
                        <label class="mb-2 ml-1 text-xs font-bold uppercase tracking-widest text-slate-500">
                            Remark
                        </label>
                        <textarea name="remark" rows="4"
                            placeholder="e.g. Used for project / damaged items"
                            class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 px-4 py-3.5 text-sm focus:border-rose-500 focus:bg-white focus:ring-4 focus:ring-rose-500/10">{{ old('remark') }}</textarea>
                    </div>

                    {{-- WARNING --}}
                    <div class="rounded-2xl bg-rose-50 border border-rose-100 p-4 text-xs text-rose-600">
                        ⚠ This will reduce stock immediately. Ensure quantity does not exceed available inventory.
                    </div>

                    {{-- ACTION --}}
                    <button type="submit"
                        class="w-full rounded-2xl bg-rose-500 px-5 py-3 text-sm font-bold text-white hover:bg-rose-600">
                        Save Stock Out
                    </button>

                </form>

            </div>

        </div>
    </div>

    {{-- RIGHT: TABLE --}}
    <div class="xl:col-span-2">

        <div class="rounded-3xl border border-slate-100 bg-white shadow-sm overflow-hidden">

            <div class="border-b border-slate-100 p-6">
                <h2 class="text-lg font-bold text-slate-900">Recent Stock Out</h2>
                <p class="mt-1 text-sm text-slate-500">Latest outgoing inventory records.</p>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-100">
                    <thead class="bg-slate-50/50">
                        <tr>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-[0.15em] text-slate-400">Date</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-[0.15em] text-slate-400">Product</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-[0.15em] text-slate-400">Qty</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-[0.15em] text-slate-400">Ref</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-[0.15em] text-slate-400">By</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">
                        @forelse ($transactions as $transaction)
                            <tr class="hover:bg-slate-50/50">
                                <td class="px-6 py-4 text-sm text-slate-500">
                                    {{ $transaction->transaction_date?->format('d M Y') }}
                                </td>

                                <td class="px-6 py-4">
                                    <p class="font-semibold text-slate-900">{{ $transaction->product?->name }}</p>
                                    <p class="text-xs text-slate-400">{{ $transaction->product?->sku }}</p>
                                </td>

                                <td class="px-6 py-4">
                                    <span class="rounded-full bg-rose-50 px-3 py-1 text-xs font-bold text-rose-600">
                                        -{{ $transaction->quantity }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-sm text-slate-400">
                                    {{ $transaction->reference_no ?? '-' }}
                                </td>

                                <td class="px-6 py-4 text-sm text-slate-500">
                                    {{ $transaction->user?->name ?? '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-16 text-center text-slate-400">
                                    No stock out records yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($transactions->hasPages())
                <div class="border-t border-slate-100 px-6 py-4">
                    {{ $transactions->links() }}
                </div>
            @endif

        </div>

    </div>

</div>
@endsection