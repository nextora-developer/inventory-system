@csrf

<div class="grid grid-cols-1 gap-6 md:grid-cols-2">
    <div class="md:col-span-2">
        <label for="name" class="mb-2 block text-sm font-semibold text-slate-700">
            Supplier Name
        </label>
        <input type="text" name="name" id="name" value="{{ old('name', $supplier->name ?? '') }}"
            class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-slate-900 focus:outline-none"
            placeholder="Enter supplier name">
        @error('name')
            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="contact_person" class="mb-2 block text-sm font-semibold text-slate-700">
            Contact Person
        </label>
        <input type="text" name="contact_person" id="contact_person"
            value="{{ old('contact_person', $supplier->contact_person ?? '') }}"
            class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-slate-900 focus:outline-none"
            placeholder="Enter contact person">
        @error('contact_person')
            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="phone" class="mb-2 block text-sm font-semibold text-slate-700">
            Phone
        </label>
        <input type="text" name="phone" id="phone" value="{{ old('phone', $supplier->phone ?? '') }}"
            class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-slate-900 focus:outline-none"
            placeholder="Enter phone number">
        @error('phone')
            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="md:col-span-2">
        <label for="email" class="mb-2 block text-sm font-semibold text-slate-700">
            Email
        </label>
        <input type="email" name="email" id="email" value="{{ old('email', $supplier->email ?? '') }}"
            class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-slate-900 focus:outline-none"
            placeholder="Enter email address">
        @error('email')
            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="md:col-span-2">
        <label for="address" class="mb-2 block text-sm font-semibold text-slate-700">
            Address
        </label>
        <textarea name="address" id="address" rows="4"
            class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-slate-900 focus:outline-none"
            placeholder="Enter supplier address">{{ old('address', $supplier->address ?? '') }}</textarea>
        @error('address')
            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="md:col-span-2">
        <label for="remark" class="mb-2 block text-sm font-semibold text-slate-700">
            Remark
        </label>
        <textarea name="remark" id="remark" rows="4"
            class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-slate-900 focus:outline-none"
            placeholder="Optional note">{{ old('remark', $supplier->remark ?? '') }}</textarea>
        @error('remark')
            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="md:col-span-2 flex items-center gap-3">
        <input type="checkbox" name="is_active" id="is_active" value="1"
            {{ old('is_active', $supplier->is_active ?? true) ? 'checked' : '' }}
            class="h-5 w-5 rounded border-slate-300 text-slate-900 focus:ring-slate-900">
        <label for="is_active" class="text-sm font-medium text-slate-700">
            Active
        </label>
    </div>

    <div class="md:col-span-2 flex items-center gap-3 pt-2">
        <button type="submit"
            class="inline-flex items-center rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
            {{ $button ?? 'Save Supplier' }}
        </button>

        <a href="{{ route('suppliers.index') }}"
            class="inline-flex items-center rounded-2xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
            Cancel
        </a>
    </div>
</div>
