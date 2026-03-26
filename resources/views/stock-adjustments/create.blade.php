@extends('layouts.admin')

@section('page-title', 'Create Stock Adjustment')

@section('content')
    <div class="mx-auto max-w-4xl rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="mb-6">
            <h2 class="text-xl font-bold text-slate-900">New Stock Adjustment</h2>
            <p class="mt-1 text-sm text-slate-500">
                Use this to manually correct stock quantity after stock count, damaged items, or system mismatch.
            </p>
        </div>

        <form action="{{ route('stock-adjustments.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="product_id" class="mb-2 block text-sm font-semibold text-slate-700">Product</label>
                <select name="product_id" id="product_id"
                    class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm">
                    <option value="">Select product</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                            {{ $product->name }} (Current Stock: {{ $product->stock_quantity }} {{ $product->unit }})
                        </option>
                    @endforeach
                </select>
                @error('product_id')
                    <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="new_quantity" class="mb-2 block text-sm font-semibold text-slate-700">New Quantity</label>
                <input type="number" name="new_quantity" id="new_quantity" value="{{ old('new_quantity') }}"
                    class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm"
                    placeholder="Enter corrected stock quantity">
                @error('new_quantity')
                    <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="reason" class="mb-2 block text-sm font-semibold text-slate-700">Reason</label>
                <input type="text" name="reason" id="reason" value="{{ old('reason') }}"
                    class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm"
                    placeholder="Example: Stock count correction / Damaged item / Missing item">
                @error('reason')
                    <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="remark" class="mb-2 block text-sm font-semibold text-slate-700">Remark</label>
                <textarea name="remark" id="remark" rows="4"
                    class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm"
                    placeholder="Optional note">{{ old('remark') }}</textarea>
                @error('remark')
                    <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-3">
                <button type="submit"
                    class="inline-flex items-center rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
                    Save Adjustment
                </button>

                <a href="{{ route('stock-adjustments.index') }}"
                    class="inline-flex items-center rounded-2xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection