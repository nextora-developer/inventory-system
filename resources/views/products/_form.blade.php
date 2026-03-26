@csrf

<div class="grid grid-cols-1 gap-6 md:grid-cols-2">
    <div class="md:col-span-2">
        <label for="category_id" class="mb-2 block text-sm font-semibold text-slate-700">
            Category
        </label>
        <select name="category_id" id="category_id"
            class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-slate-900 focus:outline-none">
            <option value="">Select category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')
            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="name" class="mb-2 block text-sm font-semibold text-slate-700">Product Name</label>
        <input type="text" name="name" id="name" value="{{ old('name', $product->name ?? '') }}"
            class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm" placeholder="Enter product name">
        @error('name')
            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="sku" class="mb-2 block text-sm font-semibold text-slate-700">SKU</label>
        <input type="text" name="sku" id="sku" value="{{ old('sku', $product->sku ?? '') }}"
            class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm" placeholder="Enter SKU">
        @error('sku')
            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="barcode" class="mb-2 block text-sm font-semibold text-slate-700">Barcode</label>
        <input type="text" name="barcode" id="barcode" value="{{ old('barcode', $product->barcode ?? '') }}"
            class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm" placeholder="Enter barcode">
    </div>

    <div>
        <label for="brand" class="mb-2 block text-sm font-semibold text-slate-700">Brand</label>
        <input type="text" name="brand" id="brand" value="{{ old('brand', $product->brand ?? '') }}"
            class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm" placeholder="Enter brand">
    </div>

    <div>
        <label for="unit" class="mb-2 block text-sm font-semibold text-slate-700">Unit</label>
        <input type="text" name="unit" id="unit" value="{{ old('unit', $product->unit ?? 'pcs') }}"
            class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm" placeholder="pcs / box / bottle">
        @error('unit')
            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="cost_price" class="mb-2 block text-sm font-semibold text-slate-700">Cost Price</label>
        <input type="number" step="0.01" name="cost_price" id="cost_price"
            value="{{ old('cost_price', $product->cost_price ?? 0) }}"
            class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm" placeholder="0.00">
        @error('cost_price')
            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="selling_price" class="mb-2 block text-sm font-semibold text-slate-700">Selling Price</label>
        <input type="number" step="0.01" name="selling_price" id="selling_price"
            value="{{ old('selling_price', $product->selling_price ?? 0) }}"
            class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm" placeholder="0.00">
        @error('selling_price')
            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="stock_quantity" class="mb-2 block text-sm font-semibold text-slate-700">Stock Quantity</label>
        <input type="number" name="stock_quantity" id="stock_quantity"
            value="{{ old('stock_quantity', $product->stock_quantity ?? 0) }}"
            class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm" placeholder="0">
        @error('stock_quantity')
            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="minimum_stock" class="mb-2 block text-sm font-semibold text-slate-700">Minimum Stock Alert</label>
        <input type="number" name="minimum_stock" id="minimum_stock"
            value="{{ old('minimum_stock', $product->minimum_stock ?? 0) }}"
            class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm" placeholder="0">
        @error('minimum_stock')
            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="md:col-span-2">
        <label for="location" class="mb-2 block text-sm font-semibold text-slate-700">Location / Rack</label>
        <input type="text" name="location" id="location" value="{{ old('location', $product->location ?? '') }}"
            class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm" placeholder="Example: Rack A-01">
    </div>

    <div class="md:col-span-2">
        <label for="description" class="mb-2 block text-sm font-semibold text-slate-700">Description</label>
        <textarea name="description" id="description" rows="4"
            class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm" placeholder="Enter product description">{{ old('description', $product->description ?? '') }}</textarea>
    </div>

    <div class="md:col-span-2 flex items-center gap-3">
        <input type="checkbox" name="is_active" id="is_active" value="1"
            {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }}
            class="h-5 w-5 rounded border-slate-300 text-slate-900 focus:ring-slate-900">
        <label for="is_active" class="text-sm font-medium text-slate-700">
            Active
        </label>
    </div>

    <div class="md:col-span-2 flex items-center gap-3 pt-2">
        <button type="submit"
            class="inline-flex items-center rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
            {{ $button ?? 'Save Product' }}
        </button>

        <a href="{{ route('products.index') }}"
            class="inline-flex items-center rounded-2xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
            Cancel
        </a>
    </div>
</div>
