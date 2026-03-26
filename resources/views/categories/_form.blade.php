@csrf

<div class="space-y-8">
    {{-- Category Name Input --}}
    <div class="group">
        <label for="name"
            class="mb-2 ml-1 block text-xs font-bold uppercase tracking-widest text-slate-500 transition-colors group-focus-within:text-[#8b5cf6]">
            Category Name
        </label>
        <div class="relative">
            <input type="text" name="name" id="name" value="{{ old('name', $category->name ?? '') }}" required
                class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 px-4 py-3.5 text-sm text-slate-900 transition-all duration-200 outline-none placeholder:text-slate-400 focus:border-[#8b5cf6] focus:bg-white focus:ring-4 focus:ring-[#8b5cf6]/10"
                placeholder="e.g. Electronics, Raw Materials, Office Supplies">

            @error('name')
                <div class="mt-2 flex items-center gap-2 px-1 text-rose-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                            clip-rule="evenodd" />
                    </svg>
                    <p class="text-xs font-semibold">{{ $message }}</p>
                </div>
            @enderror
        </div>
    </div>

    {{-- Description Input --}}
    <div class="group">
        <label for="description"
            class="mb-2 ml-1 block text-xs font-bold uppercase tracking-widest text-slate-500 transition-colors group-focus-within:text-[#8b5cf6]">
            Category Description
        </label>
        <textarea name="description" id="description" rows="4"
            class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 px-4 py-3.5 text-sm text-slate-900 transition-all duration-200 outline-none placeholder:text-slate-400 focus:border-[#8b5cf6] focus:bg-white focus:ring-4 focus:ring-[#8b5cf6]/10"
            placeholder="Briefly describe what items fall under this classification...">{{ old('description', $category->description ?? '') }}</textarea>
        @error('description')
            <p class="mt-2 px-1 text-xs font-semibold text-rose-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Status Toggle Area --}}
    <div class="rounded-2xl border-2 border-slate-100 bg-slate-50/50 p-4 transition-colors hover:border-slate-200">
        <label for="is_active" class="flex cursor-pointer items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-slate-900">Visibility Status</p>
                    <p class="text-xs text-slate-500">Toggle if this category should be visible in product selection.
                    </p>
                </div>
            </div>

            <div class="relative inline-flex cursor-pointer items-center">
                <input type="checkbox" name="is_active" id="is_active" value="1"
                    {{ old('is_active', $category->is_active ?? true) ? 'checked' : '' }} class="peer sr-only">
                <div
                    class="h-6 w-11 rounded-full bg-slate-200 transition-colors peer-checked:bg-emerald-500 after:absolute after:left-[2px] after:top-[2px] after:h-5 after:w-5 after:rounded-full after:bg-white after:transition-all peer-checked:after:translate-x-full">
                </div>
            </div>
        </label>
    </div>

    {{-- Action Buttons --}}
    <div class="flex flex-col gap-3 pt-4 sm:flex-row sm:items-center sm:justify-end">
        <a href="{{ route('categories.index') }}"
            class="order-2 inline-flex items-center justify-center rounded-2xl px-6 py-3.5 text-sm font-bold text-slate-500 transition hover:bg-slate-100 sm:order-1">
            Cancel
        </a>

        <button type="submit"
            class="order-1 inline-flex items-center justify-center gap-2 rounded-2xl bg-[#8b5cf6] px-8 py-3.5 text-sm font-bold text-white shadow-lg shadow-indigo-100 transition-all hover:bg-[#7c3aed] hover:shadow-indigo-200 active:scale-95 sm:order-2">
            <span>{{ $button ?? 'Save Category' }}</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
            </svg>
        </button>
    </div>
</div>
