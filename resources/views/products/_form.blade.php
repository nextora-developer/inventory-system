@csrf

<div class="space-y-8">

    {{-- Category --}}
    <div class="group">
        <label
            class="mb-2 ml-1 block text-xs font-bold uppercase tracking-widest text-slate-500 group-focus-within:text-[#8b5cf6]">
            Category
        </label>
        <select name="category_id"
            class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 px-4 py-3.5 text-sm focus:border-[#8b5cf6] focus:bg-white focus:ring-4 focus:ring-[#8b5cf6]/10">
            <option value="">Select category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Grid --}}
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

        {{-- Name --}}
        <div class="group md:col-span-2">
            <label
                class="mb-2 ml-1 block text-xs font-bold uppercase tracking-widest text-slate-500 group-focus-within:text-[#8b5cf6]">
                Product Name
            </label>
            <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}"
                placeholder="e.g. Wireless Mouse, Office Chair"
                class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 px-4 py-3.5 text-sm focus:border-[#8b5cf6] focus:bg-white focus:ring-4 focus:ring-[#8b5cf6]/10">
        </div>

        {{-- SKU --}}
        <div class="group">
            <label
                class="mb-2 ml-1 text-xs font-bold uppercase tracking-widest text-slate-500 group-focus-within:text-[#8b5cf6]">
                SKU
            </label>
            <input type="text" name="sku" value="{{ old('sku', $product->sku ?? '') }}"
                placeholder="e.g. WM-001-BLK"
                class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 px-4 py-3.5 text-sm focus:border-[#8b5cf6] focus:bg-white focus:ring-4 focus:ring-[#8b5cf6]/10">
        </div>

        {{-- Barcode --}}
        <div class="group">
            <label
                class="mb-2 ml-1 text-xs font-bold uppercase tracking-widest text-slate-500 group-focus-within:text-[#8b5cf6]">
                Barcode
            </label>
            <input type="text" name="barcode" value="{{ old('barcode', $product->barcode ?? '') }}"
                placeholder="Scan or enter barcode (optional)"
                class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 px-4 py-3.5 text-sm focus:border-[#8b5cf6] focus:bg-white focus:ring-4 focus:ring-[#8b5cf6]/10">
        </div>

        {{-- Brand --}}
        <div class="group">
            <label
                class="mb-2 ml-1 text-xs font-bold uppercase tracking-widest text-slate-500 group-focus-within:text-[#8b5cf6]">
                Brand
            </label>
            <input type="text" name="brand" value="{{ old('brand', $product->brand ?? '') }}"
                placeholder="e.g. Logitech, IKEA"
                class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 px-4 py-3.5 text-sm focus:border-[#8b5cf6] focus:bg-white focus:ring-4 focus:ring-[#8b5cf6]/10">
        </div>

        {{-- Unit --}}
        <div class="group">
            <label
                class="mb-2 ml-1 text-xs font-bold uppercase tracking-widest text-slate-500 group-focus-within:text-[#8b5cf6]">
                Unit
            </label>
            <input type="text" name="unit" value="{{ old('unit', $product->unit ?? 'pcs') }}"
                placeholder="e.g. pcs, box, bottle"
                class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 px-4 py-3.5 text-sm focus:border-[#8b5cf6] focus:bg-white focus:ring-4 focus:ring-[#8b5cf6]/10">
        </div>

        {{-- Cost --}}
        <div class="group">
            <label
                class="mb-2 ml-1 text-xs font-bold uppercase tracking-widest text-slate-500 group-focus-within:text-[#8b5cf6]">
                Cost Price
            </label>
            <input type="number" step="0.01" name="cost_price"
                value="{{ old('cost_price', $product->cost_price ?? 0) }}" placeholder="e.g. 25.00"
                class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 px-4 py-3.5 text-sm focus:border-[#8b5cf6] focus:bg-white focus:ring-4 focus:ring-[#8b5cf6]/10">
        </div>

        {{-- Sell --}}
        <div class="group">
            <label
                class="mb-2 ml-1 text-xs font-bold uppercase tracking-widest text-slate-500 group-focus-within:text-[#8b5cf6]">
                Selling Price
            </label>
            <input type="number" step="0.01" name="selling_price"
                value="{{ old('selling_price', $product->selling_price ?? 0) }}" placeholder="e.g. 39.90"
                class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 px-4 py-3.5 text-sm focus:border-[#8b5cf6] focus:bg-white focus:ring-4 focus:ring-[#8b5cf6]/10">
        </div>

        {{-- Stock --}}
        <div class="group">
            <label
                class="mb-2 ml-1 text-xs font-bold uppercase tracking-widest text-slate-500 group-focus-within:text-[#8b5cf6]">
                Stock Quantity
            </label>
            <input type="number" name="stock_quantity"
                value="{{ old('stock_quantity', $product->stock_quantity ?? 0) }}" placeholder="e.g. 100"
                class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 px-4 py-3.5 text-sm focus:border-[#8b5cf6] focus:bg-white focus:ring-4 focus:ring-[#8b5cf6]/10">
        </div>

        {{-- Min --}}
        <div class="group">
            <label
                class="mb-2 ml-1 text-xs font-bold uppercase tracking-widest text-slate-500 group-focus-within:text-[#8b5cf6]">
                Minimum Stock
            </label>
            <input type="number" name="minimum_stock" value="{{ old('minimum_stock', $product->minimum_stock ?? 0) }}"
                placeholder="e.g. 10 (low stock alert)"
                class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 px-4 py-3.5 text-sm focus:border-[#8b5cf6] focus:bg-white focus:ring-4 focus:ring-[#8b5cf6]/10">
        </div>

        {{-- Location --}}
        <div class="group md:col-span-2">
            <label
                class="mb-2 ml-1 text-xs font-bold uppercase tracking-widest text-slate-500 group-focus-within:text-[#8b5cf6]">
                Location
            </label>
            <input type="text" name="location" value="{{ old('location', $product->location ?? '') }}"
                placeholder="e.g. Rack A-01, Warehouse B"
                class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 px-4 py-3.5 text-sm focus:border-[#8b5cf6] focus:bg-white focus:ring-4 focus:ring-[#8b5cf6]/10">
        </div>

        {{-- Description --}}
        <div class="group md:col-span-2">
            <label
                class="mb-2 ml-1 text-xs font-bold uppercase tracking-widest text-slate-500 group-focus-within:text-[#8b5cf6]">
                Description
            </label>
            <textarea name="description" rows="4" placeholder="Optional notes about this product..."
                class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 px-4 py-3.5 text-sm focus:border-[#8b5cf6] focus:bg-white focus:ring-4 focus:ring-[#8b5cf6]/10">{{ old('description', $product->description ?? '') }}</textarea>
        </div>
    </div>

    {{-- Modern Toggle Switch --}}
    <div
        class="group relative rounded-3xl border-2 border-slate-100 bg-slate-50/50 p-5 transition-all duration-300 hover:border-slate-200 hover:bg-white hover:shadow-xl hover:shadow-slate-200/40">
        <label for="is_active" class="flex cursor-pointer items-center justify-between">
            <div class="flex items-center gap-4">
                {{-- Context Icon: Changes color based on toggle state --}}
                <div
                    class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white shadow-sm transition-colors duration-500 peer-checked:bg-emerald-50">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 text-slate-400 transition-colors group-hover:text-slate-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>

                <div>
                    <p class="text-sm font-bold tracking-tight text-slate-900">Operational Status</p>
                    <p class="text-xs font-medium text-slate-500">Toggle visibility across the inventory system.</p>
                </div>
            </div>

            {{-- The Custom Switch --}}
            <div class="relative inline-flex items-center">
                <input type="checkbox" name="is_active" id="is_active" value="1"
                    {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }} class="peer sr-only">

                {{-- Switch Background --}}
                <div
                    class="h-7 w-12 rounded-full bg-slate-200 transition-all duration-300 ring-4 ring-transparent peer-focus:ring-[#8b5cf6]/10 peer-checked:bg-emerald-500">
                </div>

                {{-- Switch Knob --}}
                <div
                    class="absolute left-[4px] top-[4px] h-5 w-5 rounded-full bg-white shadow-md transition-all duration-300 peer-checked:translate-x-5">
                </div>
            </div>
        </label>
    </div>
    {{-- Actions --}}
    <div class="flex justify-end gap-3 pt-4">
        <a href="{{ route('products.index') }}"
            class="rounded-2xl px-6 py-3 text-sm font-bold text-slate-500 hover:bg-slate-100">
            Cancel
        </a>

        <button type="submit"
            class="rounded-2xl bg-[#8b5cf6] px-8 py-3 text-sm font-bold text-white hover:bg-[#7c3aed]">
            {{ $button ?? 'Save Product' }}
        </button>
    </div>

</div>
