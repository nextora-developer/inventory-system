@extends('layouts.admin')

@section('page-title', 'Stock Out')

@section('content')
    <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">
        <div class="xl:col-span-1">
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-slate-900">Create Stock Out</h2>
                    <p class="mt-1 text-sm text-slate-500">Remove stock from inventory.</p>
                </div>

                <form action="{{ route('stock.out.store') }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label for="product_id" class="mb-2 block text-sm font-semibold text-slate-700">Product</label>
                        <select name="product_id" id="product_id"
                            class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm">
                            <option value="">Select product</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}"
                                    {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                    {{ $product->name }} (Stock: {{ $product->stock_quantity }} {{ $product->unit }})
                                </option>
                            @endforeach
                        </select>
                        @error('product_id')
                            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="quantity" class="mb-2 block text-sm font-semibold text-slate-700">Quantity</label>
                        <input type="number" name="quantity" id="quantity" value="{{ old('quantity') }}"
                            class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm"
                            placeholder="Enter quantity">
                        @error('quantity')
                            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="reference_no" class="mb-2 block text-sm font-semibold text-slate-700">Reference
                            No</label>
                        <input type="text" name="reference_no" id="reference_no" value="{{ old('reference_no') }}"
                            class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm"
                            placeholder="Issue / Request No">
                    </div>

                    <div>
                        <label for="transaction_date" class="mb-2 block text-sm font-semibold text-slate-700">Transaction
                            Date</label>
                        <input type="date" name="transaction_date" id="transaction_date"
                            value="{{ old('transaction_date', now()->format('Y-m-d')) }}"
                            class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm">
                    </div>

                    <div>
                        <label for="remark" class="mb-2 block text-sm font-semibold text-slate-700">Remark</label>
                        <textarea name="remark" id="remark" rows="4"
                            class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm" placeholder="Optional note">{{ old('remark') }}</textarea>
                    </div>

                    <button type="submit"
                        class="w-full rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
                        Save Stock Out
                    </button>
                </form>
            </div>
        </div>

        <div class="xl:col-span-2">
            <div class="rounded-3xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 p-6">
                    <h2 class="text-lg font-bold text-slate-900">Recent Stock Out</h2>
                    <p class="mt-1 text-sm text-slate-500">Latest outgoing stock transactions.</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.2em] text-slate-500">
                                    Date</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.2em] text-slate-500">
                                    Product</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.2em] text-slate-500">
                                    Qty</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.2em] text-slate-500">
                                    Ref</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.2em] text-slate-500">
                                    By</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            @forelse ($transactions as $transaction)
                                <tr>
                                    <td class="px-6 py-4 text-sm text-slate-500">
                                        {{ $transaction->transaction_date?->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="font-semibold text-slate-900">{{ $transaction->product?->name }}</p>
                                        <p class="mt-1 text-sm text-slate-500">{{ $transaction->product?->sku }}</p>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-semibold text-rose-600">
                                        -{{ $transaction->quantity }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-500">
                                        {{ $transaction->reference_no ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-500">
                                        {{ $transaction->user?->name ?? '-' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-10 text-center text-sm text-slate-500">
                                        No stock out records yet.
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
        </div>
    </div>
@endsection
