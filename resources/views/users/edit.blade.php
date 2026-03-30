@extends('layouts.admin')

@section('page-title', 'Edit User')

@section('content')
    <div class="mx-auto max-w-4xl">

        {{-- Breadcrumb --}}
        <div class="mb-6 hidden md:flex items-center justify-between">
            <nav class="flex items-center gap-2 text-sm font-medium">
                <a href="{{ route('users.index') }}" class="text-slate-500 transition-colors hover:text-[#8b5cf6]">
                    Users
                </a>

                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-300" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                </svg>

                <span class="text-slate-900">Edit User</span>
            </nav>

            <a href="{{ route('users.index') }}"
                class="group inline-flex items-center gap-2 text-sm font-bold text-slate-500 transition-colors hover:text-slate-900">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:-translate-x-1"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Back to List
            </a>
        </div>

        {{-- Card --}}
        <div class="overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-xl shadow-slate-200/50">

            {{-- Gradient Top --}}
            <div class="h-2 bg-gradient-to-r from-[#8b5cf6] via-[#c084fc] to-indigo-500"></div>

            <div class="p-8 lg:p-10">

                {{-- Header --}}
                <div class="mb-10 flex items-start justify-between">
                    <div>
                        <h2 class="text-2xl font-black tracking-tight text-slate-900">
                            Edit User
                        </h2>
                        <p class="mt-2 text-slate-500">
                            Update account details, role assignment, and access settings.
                        </p>
                    </div>

                    {{-- Icon --}}
                    <div
                        class="hidden h-14 w-14 items-center justify-center rounded-2xl bg-indigo-50 text-[#8b5cf6] sm:flex">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>

                    </div>
                </div>

                {{-- Form --}}
                <form action="{{ route('users.update', $user) }}" method="POST" class="space-y-0">
                    @csrf
                    @method('PUT')

                    @include('users._form', [
                        'button' => 'Update User',
                        'user' => $user,
                        'roles' => $roles,
                    ])
                </form>
            </div>

            {{-- Footer Hint --}}
            <div class="border-t border-slate-100 bg-slate-50 px-8 py-4">
                <p class="flex items-center gap-2 text-xs text-slate-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Role and status changes may immediately affect this user's access permissions.
                </p>
            </div>

        </div>
    </div>
@endsection
