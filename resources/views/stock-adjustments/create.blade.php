@extends('layouts.admin')

@section('page-title', 'Create Stock Adjustment')

@section('content')
    <div class="mx-auto max-w-4xl">

        {{-- Breadcrumb --}}
        <div class="mb-6 flex items-center justify-between">
            <nav class="flex items-center gap-2 text-sm font-medium">
                <a href="{{ route('stock-adjustments.index') }}"
                    class="text-slate-500 hover:text-[#8b5cf6] transition-colors">
                    Stock Adjustments
                </a>

                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-300" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                </svg>

                <span class="text-slate-900">New Adjustment</span>
            </nav>

            <a href="{{ route('stock-adjustments.index') }}"
                class="group inline-flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-slate-900 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:-translate-x-1"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Back to List
            </a>
        </div>

        {{-- Card --}}
        <div class="overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-xl shadow-slate-200/50">

            {{-- Gradient --}}
            <div class="h-2 bg-gradient-to-r from-[#8b5cf6] via-[#c084fc] to-indigo-500"></div>

            <div class="p-8 lg:p-10">

                {{-- Header --}}
                <div class="mb-10">
                    <h2 class="text-2xl font-black tracking-tight text-slate-900">
                        Stock Adjustment
                    </h2>
                    <p class="mt-2 text-slate-500">
                        Manually correct inventory after stock count, damaged goods, or discrepancies.
                    </p>
                </div>

                <form action="{{ route('stock-adjustments.store') }}" method="POST" class="space-y-8">
                    @csrf

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                        {{-- Row 1 --}}
                        {{-- Product --}}
                        <div class="group">
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
                                        {{ $product->name }} ({{ $product->stock_quantity }} {{ $product->unit }})
                                    </option>
                                @endforeach
                            </select>
                            @error('product_id')
                                <p class="mt-2 text-xs font-semibold text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- New Quantity --}}
                        <div class="group">
                            <label
                                class="mb-2 ml-1 block text-xs font-bold uppercase tracking-widest text-slate-500 group-focus-within:text-[#8b5cf6]">
                                New Quantity
                            </label>
                            <input type="number" name="new_quantity" value="{{ old('new_quantity') }}"
                                placeholder="e.g. 120"
                                class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 px-4 py-3.5 text-sm text-slate-900 placeholder:text-slate-400 focus:border-[#8b5cf6] focus:bg-white focus:ring-4 focus:ring-[#8b5cf6]/10">
                            @error('new_quantity')
                                <p class="mt-2 text-xs font-semibold text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Row 2 --}}
                        {{-- Reason --}}
                        <div class="group md:col-span-2">
                            <label class="mb-2 ml-1 block text-xs font-bold uppercase tracking-widest text-slate-500">
                                Reason
                            </label>
                            <input type="text" name="reason" value="{{ old('reason') }}"
                                placeholder="e.g. Stock count correction, Damaged item"
                                class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 px-4 py-3.5 text-sm text-slate-900 placeholder:text-slate-400 focus:border-[#8b5cf6] focus:bg-white focus:ring-4 focus:ring-[#8b5cf6]/10">
                        </div>

                        {{-- Row 3 --}}
                        {{-- Remark --}}
                        <div class="group md:col-span-2">
                            <label class="mb-2 ml-1 block text-xs font-bold uppercase tracking-widest text-slate-500">
                                Remark
                            </label>
                            <textarea name="remark" rows="4" placeholder="Optional notes about this adjustment..."
                                class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 px-4 py-3.5 text-sm text-slate-900 placeholder:text-slate-400 focus:border-[#8b5cf6] focus:bg-white focus:ring-4 focus:ring-[#8b5cf6]/10">{{ old('remark') }}</textarea>
                        </div>

                    </div>

                    {{-- Actions --}}
                    <div class="flex justify-end gap-3 pt-4">
                        <a href="{{ route('stock-adjustments.index') }}"
                            class="rounded-2xl px-6 py-3 text-sm font-bold text-slate-500 hover:bg-slate-100">
                            Cancel
                        </a>

                        <button type="submit"
                            class="rounded-2xl bg-[#8b5cf6] px-8 py-3 text-sm font-bold text-white hover:bg-[#7c3aed]">
                            Save Adjustment
                        </button>
                    </div>

                </form>
            </div>

            {{-- Footer --}}
            <div class="border-t border-slate-100 bg-slate-50 px-8 py-4">
                <p class="text-xs text-slate-400 flex items-center gap-2">
                    ⚠ This will directly overwrite the current stock quantity and create a history record.
                </p>
            </div>

        </div>
    </div>
@endsection
