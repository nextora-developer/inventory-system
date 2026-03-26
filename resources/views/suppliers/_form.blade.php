@csrf

<div class="space-y-8">
    {{-- SECTION 1: IDENTITY & CONTACT --}}
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">

        {{-- Supplier Name --}}
        <div class="group md:col-span-2 lg:col-span-1">
            <label
                class="mb-2 ml-1 block text-xs font-bold uppercase tracking-widest text-slate-500 group-focus-within:text-[#8b5cf6] transition-colors">
                Company Name
            </label>
            <input type="text" name="name" value="{{ old('name', $supplier->name ?? '') }}" required
                class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 px-4 py-3 text-sm text-slate-900 transition-all outline-none placeholder:text-slate-400 focus:border-[#8b5cf6] focus:bg-white focus:ring-4 focus:ring-[#8b5cf6]/10"
                placeholder="Global Corp Ltd.">
            @error('name')
                <p class="mt-2 px-1 text-xs font-semibold text-rose-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Contact Person --}}
        <div class="group md:col-span-2 lg:col-span-1">
            <label
                class="mb-2 ml-1 block text-xs font-bold uppercase tracking-widest text-slate-500 group-focus-within:text-[#8b5cf6] transition-colors">
                Contact Person
            </label>
            <input type="text" name="contact_person"
                value="{{ old('contact_person', $supplier->contact_person ?? '') }}"
                class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 px-4 py-3 text-sm text-slate-900 transition-all outline-none placeholder:text-slate-400 focus:border-[#8b5cf6] focus:bg-white focus:ring-4 focus:ring-[#8b5cf6]/10"
                placeholder="John Doe">
            @error('contact_person')
                <p class="mt-2 px-1 text-xs font-semibold text-rose-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Phone --}}
        <div class="group md:col-span-2 lg:col-span-1">
            <label
                class="mb-2 ml-1 block text-xs font-bold uppercase tracking-widest text-slate-500 group-focus-within:text-[#8b5cf6] transition-colors">
                Phone Number
            </label>
            <input type="text" name="phone" value="{{ old('phone', $supplier->phone ?? '') }}"
                class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 px-4 py-3 text-sm text-slate-900 transition-all outline-none placeholder:text-slate-400 focus:border-[#8b5cf6] focus:bg-white focus:ring-4 focus:ring-[#8b5cf6]/10"
                placeholder="+1 234 567 890">
            @error('phone')
                <p class="mt-2 px-1 text-xs font-semibold text-rose-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div class="group md:col-span-2 lg:col-span-1">
            <label
                class="mb-2 ml-1 block text-xs font-bold uppercase tracking-widest text-slate-500 group-focus-within:text-[#8b5cf6] transition-colors">
                Business Email
            </label>
            <input type="email" name="email" value="{{ old('email', $supplier->email ?? '') }}"
                class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 px-4 py-3 text-sm text-slate-900 transition-all outline-none placeholder:text-slate-400 focus:border-[#8b5cf6] focus:bg-white focus:ring-4 focus:ring-[#8b5cf6]/10"
                placeholder="orders@supplier.com">
            @error('email')
                <p class="mt-2 px-1 text-xs font-semibold text-rose-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    {{-- SECTION 2: LOGISTICS & REMARKS --}}
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
        <div class="group">
            <label
                class="mb-2 ml-1 block text-xs font-bold uppercase tracking-widest text-slate-500 group-focus-within:text-[#8b5cf6] transition-colors">
                Physical Address
            </label>
            <textarea name="address" rows="4"
                class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 px-4 py-3 text-sm text-slate-900 transition-all outline-none placeholder:text-slate-400 focus:border-[#8b5cf6] focus:bg-white focus:ring-4 focus:ring-[#8b5cf6]/10"
                placeholder="Full operational address...">{{ old('address', $supplier->address ?? '') }}</textarea>
            @error('address')
                <p class="mt-2 px-1 text-xs font-semibold text-rose-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="group">
            <label
                class="mb-2 ml-1 block text-xs font-bold uppercase tracking-widest text-slate-500 group-focus-within:text-[#8b5cf6] transition-colors">
                Remarks
            </label>
            <textarea name="remark" rows="4"
                class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 px-4 py-3 text-sm text-slate-900 transition-all outline-none placeholder:text-slate-400 focus:border-[#8b5cf6] focus:bg-white focus:ring-4 focus:ring-[#8b5cf6]/10"
                placeholder="Contract terms, lead times, or special notes...">{{ old('remark', $supplier->remark ?? '') }}</textarea>
            @error('remark')
                <p class="mt-2 px-1 text-xs font-semibold text-rose-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    {{-- STATUS TOGGLE --}}
    <div class="rounded-3xl border-2 border-slate-100 bg-slate-50/50 p-5 transition-all hover:border-slate-200">
        <label for="is_active" class="flex cursor-pointer items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white shadow-sm text-[#8b5cf6]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-slate-900">Partnership Status</p>
                    <p class="text-xs text-slate-500">Active suppliers appear in purchase and inventory logs.</p>
                </div>
            </div>

            <div class="relative inline-flex cursor-pointer items-center">
                <input type="checkbox" name="is_active" id="is_active" value="1"
                    {{ old('is_active', $supplier->is_active ?? true) ? 'checked' : '' }} class="peer sr-only">
                <div
                    class="h-7 w-12 rounded-full bg-slate-200 transition-colors peer-checked:bg-[#8b5cf6] after:absolute after:left-[4px] after:top-[4px] after:h-5 after:w-5 after:rounded-full after:bg-white after:transition-all peer-checked:after:translate-x-5">
                </div>
            </div>
        </label>
    </div>

    {{-- ACTION BUTTONS --}}
    <div class="flex flex-col gap-3 pt-6 sm:flex-row sm:items-center sm:justify-end border-t border-slate-100">
        <a href="{{ route('suppliers.index') }}"
            class="order-2 inline-flex items-center justify-center rounded-2xl px-8 py-3.5 text-sm font-bold text-slate-500 transition hover:bg-slate-100 sm:order-1">
            Cancel
        </a>

        <button type="submit"
            class="order-1 inline-flex items-center justify-center gap-2 rounded-2xl bg-slate-900 px-10 py-3.5 text-sm font-bold text-white shadow-xl shadow-slate-200 transition-all hover:bg-slate-800 hover:shadow-slate-300 active:scale-95 sm:order-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
            </svg>
            <span>{{ $button ?? 'Register Supplier' }}</span>
        </button>
    </div>
</div>
