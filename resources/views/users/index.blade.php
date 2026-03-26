@extends('layouts.admin')

@section('page-title', 'Users')

@section('content')
    <div class="rounded-3xl border border-slate-100 bg-white shadow-sm overflow-hidden">

        {{-- Header --}}
        <div class="flex flex-col gap-4 border-b border-slate-100 p-6 lg:flex-row lg:items-center lg:justify-between bg-white">
            <div>
                <h2 class="text-xl font-bold text-slate-900">User Access Control</h2>
                <p class="mt-1 text-sm text-slate-500">Manage system users, roles, and permissions.</p>
            </div>

            <div class="flex flex-col gap-3 sm:flex-row">

                {{-- Search --}}
                <form method="GET" action="{{ route('users.index') }}" class="flex gap-2">
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm focus:border-[#8b5cf6] focus:ring-2 focus:ring-[#8b5cf6]/20 sm:w-64"
                        placeholder="Search name, email, role...">

                    <button type="submit"
                        class="rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                        Search
                    </button>
                </form>

                {{-- Add --}}
                <a href="{{ route('users.create') }}"
                    class="group inline-flex items-center gap-2 rounded-2xl bg-[#8b5cf6] px-6 py-3 text-sm font-bold text-white transition-all hover:bg-[#7c3aed] hover:shadow-lg hover:shadow-indigo-100 active:scale-95">
                    
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 transition-transform group-hover:rotate-90"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>

                    Create User
                </a>
            </div>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-100">

                {{-- Head --}}
                <thead class="bg-slate-50/50">
                    <tr>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-400">No</th>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-400">User</th>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-400">Role</th>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-400">Created</th>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-400">Status</th>
                        <th class="px-6 py-4 text-right text-[11px] font-bold uppercase tracking-[0.15em] text-slate-400">Action</th>
                    </tr>
                </thead>

                {{-- Body --}}
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse ($users as $user)
                        <tr class="group transition-all hover:bg-slate-50/50">

                            {{-- No --}}
                            <td class="px-6 py-4 text-sm font-mono text-slate-400">
                                #{{ str_pad($loop->iteration + ($users->currentPage() - 1) * $users->perPage(), 2, '0', STR_PAD_LEFT) }}
                            </td>

                            {{-- User --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">

                                    {{-- Avatar --}}
                                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-100 text-indigo-600 font-bold">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>

                                    <div>
                                        <p class="font-bold text-slate-900">{{ $user->name }}</p>
                                        <p class="mt-0.5 text-xs text-slate-400">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </td>

                            {{-- Role --}}
                            <td class="px-6 py-4">
                                @php
                                    $roleClass = match ($user->role) {
                                        'admin' => 'bg-indigo-50 text-indigo-700 ring-indigo-500/20',
                                        'manager' => 'bg-blue-50 text-blue-700 ring-blue-500/20',
                                        'staff' => 'bg-emerald-50 text-emerald-700 ring-emerald-500/20',
                                        'storekeeper' => 'bg-amber-50 text-amber-700 ring-amber-500/20',
                                        default => 'bg-slate-100 text-slate-700 ring-slate-400/20',
                                    };
                                @endphp

                                <span class="inline-flex items-center rounded-full px-3 py-1 text-[11px] font-bold ring-1 ring-inset {{ $roleClass }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>

                            {{-- Created --}}
                            <td class="px-6 py-4 text-sm text-slate-500 font-medium">
                                {{ $user->created_at->format('d M, Y') }}
                            </td>

                            {{-- Status --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">

                                    {{-- Toggle --}}
                                    <form action="{{ route('users.toggle-status', $user) }}" method="POST">
                                        @csrf
                                        @method('PATCH')

                                        <button type="submit"
                                            class="relative inline-flex h-6 w-11 items-center rounded-full transition
                                                {{ $user->is_active ? 'bg-emerald-500' : 'bg-slate-300' }}">
                                            <span
                                                class="inline-block h-4 w-4 transform rounded-full bg-white transition
                                                {{ $user->is_active ? 'translate-x-6' : 'translate-x-1' }}">
                                            </span>
                                        </button>
                                    </form>

                                    {{-- Label --}}
                                    <span class="text-xs font-bold
                                        {{ $user->is_active ? 'text-emerald-600' : 'text-slate-400' }}">
                                        {{ $user->is_active ? 'Active' : 'Disabled' }}
                                    </span>
                                </div>
                            </td>

                            {{-- Action --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-3">

                                    {{-- Edit --}}
                                    <a href="{{ route('users.edit', $user) }}"
                                        class="p-2 text-slate-400 hover:text-[#8b5cf6] hover:bg-indigo-50 rounded-lg transition-all"
                                        title="Edit User">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>

                                    {{-- Delete --}}
                                    @if (auth()->id() !== $user->id)
                                        <form action="{{ route('users.destroy', $user) }}" method="POST"
                                            onsubmit="return confirm('Delete this user?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-all"
                                                title="Delete User">
                                                 <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-xs text-slate-400 font-semibold">Current</span>
                                    @endif

                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-20 text-center">
                                <p class="text-slate-500 font-medium">No users available.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        {{-- Pagination --}}
        @if ($users->hasPages())
            <div class="border-t border-slate-100 bg-slate-50/30 px-6 py-4">
                {{ $users->links() }}
            </div>
        @endif

    </div>
@endsection