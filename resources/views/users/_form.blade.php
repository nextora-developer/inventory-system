@csrf

<div class="grid grid-cols-1 gap-6 md:grid-cols-2">
    <div>
        <label for="name" class="mb-2 block text-sm font-semibold text-slate-700">Full Name</label>
        <input type="text" name="name" id="name"
            value="{{ old('name', $user->name ?? '') }}"
            class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm"
            placeholder="Enter full name">
        @error('name')
            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="email" class="mb-2 block text-sm font-semibold text-slate-700">Email Address</label>
        <input type="email" name="email" id="email"
            value="{{ old('email', $user->email ?? '') }}"
            class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm"
            placeholder="Enter email address">
        @error('email')
            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="md:col-span-2">
        <label for="role" class="mb-2 block text-sm font-semibold text-slate-700">Role</label>
        <select name="role" id="role"
            class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm">
            <option value="">Select role</option>
            @foreach ($roles as $role)
                <option value="{{ $role }}" {{ old('role', $user->role ?? '') === $role ? 'selected' : '' }}>
                    {{ ucfirst($role) }}
                </option>
            @endforeach
        </select>
        @error('role')
            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="password" class="mb-2 block text-sm font-semibold text-slate-700">
            Password
            @isset($user)
                <span class="text-slate-400">(leave blank to keep current password)</span>
            @endisset
        </label>
        <input type="password" name="password" id="password"
            class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm"
            placeholder="Enter password">
        @error('password')
            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="password_confirmation" class="mb-2 block text-sm font-semibold text-slate-700">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation"
            class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm"
            placeholder="Confirm password">
    </div>

    <div class="md:col-span-2 flex items-center gap-3 pt-2">
        <button type="submit"
            class="inline-flex items-center rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
            {{ $button ?? 'Save User' }}
        </button>

        <a href="{{ route('users.index') }}"
            class="inline-flex items-center rounded-2xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
            Cancel
        </a>
    </div>
</div>