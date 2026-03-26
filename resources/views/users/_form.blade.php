@csrf

<div class="space-y-8">

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

        {{-- Name --}}
        <div class="group">
            <label class="mb-2 ml-1 text-xs font-bold uppercase tracking-widest text-slate-500 group-focus-within:text-[#8b5cf6]">
                Full Name
            </label>
            <input type="text" name="name"
                value="{{ old('name', $user->name ?? '') }}"
                class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 px-4 py-3.5 text-sm transition focus:border-[#8b5cf6] focus:bg-white focus:ring-4 focus:ring-[#8b5cf6]/10"
                placeholder="e.g. John Tan">
            @error('name')
                <p class="mt-2 text-xs font-semibold text-rose-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div class="group">
            <label class="mb-2 ml-1 text-xs font-bold uppercase tracking-widest text-slate-500 group-focus-within:text-[#8b5cf6]">
                Email Address
            </label>
            <input type="email" name="email"
                value="{{ old('email', $user->email ?? '') }}"
                class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 px-4 py-3.5 text-sm transition focus:border-[#8b5cf6] focus:bg-white focus:ring-4 focus:ring-[#8b5cf6]/10"
                placeholder="e.g. john@email.com">
            @error('email')
                <p class="mt-2 text-xs font-semibold text-rose-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Role --}}
        <div class="group md:col-span-2">
            <label class="mb-2 ml-1 text-xs font-bold uppercase tracking-widest text-slate-500 group-focus-within:text-[#8b5cf6]">
                Role
            </label>
            <select name="role"
                class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 px-4 py-3.5 text-sm focus:border-[#8b5cf6] focus:bg-white focus:ring-4 focus:ring-[#8b5cf6]/10">
                <option value="">Select role</option>
                @foreach ($roles as $role)
                    <option value="{{ $role }}"
                        {{ old('role', $user->role ?? '') === $role ? 'selected' : '' }}>
                        {{ ucfirst($role) }}
                    </option>
                @endforeach
            </select>
            @error('role')
                <p class="mt-2 text-xs font-semibold text-rose-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password --}}
        <div class="group">
            <label class="mb-2 ml-1 text-xs font-bold uppercase tracking-widest text-slate-500 group-focus-within:text-[#8b5cf6]">
                Password
            </label>
            <input type="password" name="password"
                class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 px-4 py-3.5 text-sm focus:border-[#8b5cf6] focus:bg-white focus:ring-4 focus:ring-[#8b5cf6]/10"
                placeholder="Enter secure password">

            @isset($user)
                <p class="mt-1 text-xs text-slate-400">
                    Leave blank to keep current password
                </p>
            @endisset

            @error('password')
                <p class="mt-2 text-xs font-semibold text-rose-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Confirm Password --}}
        <div class="group">
            <label class="mb-2 ml-1 text-xs font-bold uppercase tracking-widest text-slate-500 group-focus-within:text-[#8b5cf6]">
                Confirm Password
            </label>
            <input type="password" name="password_confirmation"
                class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 px-4 py-3.5 text-sm focus:border-[#8b5cf6] focus:bg-white focus:ring-4 focus:ring-[#8b5cf6]/10"
                placeholder="Repeat password">
        </div>

    </div>

    {{-- Actions --}}
    <div class="flex flex-col gap-3 pt-4 sm:flex-row sm:justify-end">

        <a href="{{ route('users.index') }}"
            class="order-2 rounded-2xl px-6 py-3 text-sm font-bold text-slate-500 hover:bg-slate-100 sm:order-1">
            Cancel
        </a>

        <button type="submit"
            class="order-1 inline-flex items-center gap-2 rounded-2xl bg-[#8b5cf6] px-8 py-3 text-sm font-bold text-white shadow-lg shadow-indigo-100 transition hover:bg-[#7c3aed] active:scale-95 sm:order-2">
            {{ $button ?? 'Save User' }}
        </button>

    </div>

</div>