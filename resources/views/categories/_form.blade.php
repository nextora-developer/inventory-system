@csrf

<div class="grid grid-cols-1 gap-6">
    <div>
        <label for="name" class="mb-2 block text-sm font-semibold text-slate-700">
            Category Name
        </label>
        <input type="text" name="name" id="name" value="{{ old('name', $category->name ?? '') }}"
            class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-slate-900 focus:outline-none focus:ring-0"
            placeholder="Enter category name">
        @error('name')
            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="description" class="mb-2 block text-sm font-semibold text-slate-700">
            Description
        </label>
        <textarea name="description" id="description" rows="5"
            class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-slate-900 focus:outline-none focus:ring-0"
            placeholder="Enter category description">{{ old('description', $category->description ?? '') }}</textarea>
        @error('description')
            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center gap-3">
        <input type="checkbox" name="is_active" id="is_active" value="1"
            {{ old('is_active', $category->is_active ?? true) ? 'checked' : '' }}
            class="h-5 w-5 rounded border-slate-300 text-slate-900 focus:ring-slate-900">
        <label for="is_active" class="text-sm font-medium text-slate-700">
            Active
        </label>
    </div>

    <div class="flex items-center gap-3 pt-2">
        <button type="submit"
            class="inline-flex items-center rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
            {{ $button ?? 'Save Category' }}
        </button>

        <a href="{{ route('categories.index') }}"
            class="inline-flex items-center rounded-2xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
            Cancel
        </a>
    </div>
</div>
