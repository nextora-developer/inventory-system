@extends('layouts.admin')

@section('page-title', 'Stock In')

@section('content')
    <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">

        {{-- LEFT: FORM --}}
        <div class="xl:col-span-1">

            <div class="overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-xl shadow-slate-200/50">

                {{-- Gradient --}}
                <div class="h-2 bg-gradient-to-r from-[#8b5cf6] via-[#c084fc] to-indigo-500"></div>

                <div class="p-6">

                    <div class="mb-8">
                        <h2 class="text-xl font-black text-slate-900">Stock In Entry</h2>
                        <p class="mt-1 text-sm text-slate-500">
                            Record incoming stock from suppliers.
                        </p>
                    </div>

                    <form action="{{ route('stock.in.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                            {{-- Row 1 --}}
                            {{-- Product --}}
                            <div class="group md:col-span-2">
                                <label
                                    class="mb-2 ml-1 block text-xs font-bold uppercase tracking-widest text-slate-500 group-focus-within:text-[#8b5cf6]">
                                    Product
                                </label>
                                <select name="product_id"
                                    class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 px-4 py-3.5 text-sm text-slate-900 focus:border-[#8b5cf6] focus:bg-white focus:ring-4 focus:ring-[#8b5cf6]/10">
                                    <option value="">Select product</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}"
                                            {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                            {{ $product->name }} ({{ $product->sku }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Row 2 --}}
                            {{-- Supplier --}}
                            <div class="group md:col-span-2">
                                <label class="mb-2 ml-1 block text-xs font-bold uppercase tracking-widest text-slate-500">
                                    Supplier
                                </label>
                                <select name="supplier_id"
                                    class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 px-4 py-3.5 text-sm text-slate-900 focus:border-[#8b5cf6] focus:bg-white focus:ring-4 focus:ring-[#8b5cf6]/10">
                                    <option value="">Select supplier</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}"
                                            {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                            {{ $supplier->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Row 3 --}}
                            {{-- Quantity --}}
                            <div class="group">
                                <label class="mb-2 ml-1 block text-xs font-bold uppercase tracking-widest text-slate-500">
                                    Quantity
                                </label>
                                <input type="number" name="quantity" value="{{ old('quantity') }}" placeholder="e.g. 50"
                                    class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 px-4 py-3.5 text-sm text-slate-900 placeholder:text-slate-400 focus:border-[#8b5cf6] focus:bg-white focus:ring-4 focus:ring-[#8b5cf6]/10">
                            </div>

                            {{-- Unit Cost --}}
                            <div class="group">
                                <label class="mb-2 ml-1 block text-xs font-bold uppercase tracking-widest text-slate-500">
                                    Unit Cost
                                </label>
                                <input type="number" step="0.01" name="unit_cost" value="{{ old('unit_cost') }}"
                                    placeholder="e.g. 25.00"
                                    class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 px-4 py-3.5 text-sm text-slate-900 placeholder:text-slate-400 focus:border-[#8b5cf6] focus:bg-white focus:ring-4 focus:ring-[#8b5cf6]/10">
                            </div>

                            {{-- Row 4 --}}
                            {{-- Reference --}}
                            <div class="group">
                                <label class="mb-2 ml-1 block text-xs font-bold uppercase tracking-widest text-slate-500">
                                    Reference No
                                </label>
                                <input type="text" name="reference_no" value="{{ old('reference_no') }}"
                                    placeholder="e.g. INV-2026-001"
                                    class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 px-4 py-3.5 text-sm text-slate-900 placeholder:text-slate-400 focus:border-[#8b5cf6] focus:bg-white focus:ring-4 focus:ring-[#8b5cf6]/10">
                            </div>

                            {{-- Date --}}
                            <div class="group">
                                <label class="mb-2 ml-1 block text-xs font-bold uppercase tracking-widest text-slate-500">
                                    Transaction Date
                                </label>
                                <input type="date" name="transaction_date"
                                    value="{{ old('transaction_date', now()->format('Y-m-d')) }}"
                                    class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 px-4 py-3.5 text-sm text-slate-900 focus:border-[#8b5cf6] focus:bg-white focus:ring-4 focus:ring-[#8b5cf6]/10">
                            </div>

                            {{-- Row 5 --}}
                            {{-- Remark --}}
                            <div class="group md:col-span-2">
                                <label class="mb-2 ml-1 block text-xs font-bold uppercase tracking-widest text-slate-500">
                                    Remark
                                </label>
                                <textarea name="remark" rows="4" placeholder="Optional notes..."
                                    class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 px-4 py-3.5 text-sm text-slate-900 placeholder:text-slate-400 focus:border-[#8b5cf6] focus:bg-white focus:ring-4 focus:ring-[#8b5cf6]/10">{{ old('remark') }}</textarea>
                            </div>

                        </div>

                        {{-- Actions --}}
                        <button type="submit"
                            class="w-full rounded-2xl bg-[#8b5cf6] px-5 py-3 text-sm font-bold text-white transition hover:bg-[#7c3aed]">
                            Save Stock In
                        </button>

                    </form>

                </div>

                {{-- Footer --}}
                <div class="border-t border-slate-100 bg-slate-50 px-6 py-3 text-xs text-slate-400">
                    This will increase product stock and record a transaction log.
                </div>

            </div>
        </div>

        {{-- RIGHT: TABLE --}}
        <div class="xl:col-span-2">

            <div class="overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-sm">

                <div class="border-b border-slate-100 p-4 md:p-6">
                    <h2 class="text-base font-bold text-slate-900 md:text-lg">Recent Stock In</h2>
                    <p class="mt-1 text-xs text-slate-500 md:text-sm">Latest incoming inventory records.</p>
                </div>

                {{-- Mobile Card List --}}
                <div class="block md:hidden">
                    @forelse ($transactions as $transaction)
                        <div class="border-b border-slate-100 p-4 last:border-b-0">
                            <div class="flex items-start justify-between gap-3">
                                <div class="min-w-0">
                                    <p class="text-sm font-bold text-slate-900">
                                        {{ $transaction->product?->name ?? '-' }}
                                    </p>
                                    <p class="mt-1 text-xs text-slate-400">
                                        {{ $transaction->product?->sku ?? '-' }}
                                    </p>
                                </div>

                                <div class="shrink-0 text-right">
                                    <p class="text-xs font-medium text-slate-500">
                                        {{ $transaction->transaction_date?->format('d M Y') ?? '-' }}
                                    </p>
                                </div>
                            </div>

                            <div class="mt-3 flex items-center justify-between gap-3">
                                <div class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-bold text-emerald-600">
                                    +{{ $transaction->quantity }}
                                </div>

                                <p class="truncate text-xs text-slate-500">
                                    {{ $transaction->supplier?->name ?? '-' }}
                                </p>
                            </div>

                            <div class="mt-3 rounded-2xl bg-slate-50 px-3 py-2">
                                <p class="text-[11px] font-bold uppercase tracking-wide text-slate-400">Reference</p>
                                <p class="mt-1 truncate text-xs font-mono text-slate-600">
                                    {{ $transaction->reference_no ?? '-' }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <div class="px-6 py-16 text-center text-sm text-slate-400">
                            No stock in records yet.
                        </div>
                    @endforelse
                </div>

                {{-- Desktop Table --}}
                <div class="hidden overflow-x-auto md:block">
                    <table class="min-w-full divide-y divide-slate-100">
                        <thead class="bg-slate-50/50">
                            <tr>
                                <th
                                    class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.15em] text-slate-400">
                                    Date
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.15em] text-slate-400">
                                    Product
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.15em] text-slate-400">
                                    Supplier
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.15em] text-slate-400">
                                    Qty
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.15em] text-slate-400">
                                    Ref
                                </th>
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

                                    <td class="px-6 py-4 text-sm text-slate-500">
                                        {{ $transaction->supplier?->name ?? '-' }}
                                    </td>

                                    <td class="px-6 py-4">
                                        <span
                                            class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-bold text-emerald-600">
                                            +{{ $transaction->quantity }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-sm text-slate-400">
                                        {{ $transaction->reference_no ?? '-' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-16 text-center text-slate-400">
                                        No stock in records yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($transactions->hasPages())
                    <div class="border-t border-slate-100 px-4 py-4 md:px-6">
                        {{ $transactions->links() }}
                    </div>
                @endif

            </div>

        </div>

    </div>
@endsection
