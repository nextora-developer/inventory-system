@extends('layouts.admin')

@section('page-title', 'Create User')

@section('content')
    <div class="mx-auto max-w-4xl">

        {{-- Breadcrumb --}}
        <div class="mb-6 flex items-center justify-between">
            <nav class="flex items-center gap-2 text-sm font-medium">
                <a href="{{ route('users.index') }}" class="text-slate-500 transition-colors hover:text-[#8b5cf6]">
                    Users
                </a>

                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-300" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                </svg>

                <span class="text-slate-900">New User</span>
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
                            Add New User
                        </h2>
                        <p class="mt-2 text-slate-500">
                            Create a new admin panel account and assign the appropriate access role.
                        </p>
                    </div>

                    {{-- Icon --}}
                    <div
                        class="hidden h-14 w-14 items-center justify-center rounded-2xl bg-indigo-50 text-[#8b5cf6] sm:flex">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>

                    </div>
                </div>

                {{-- Form --}}
                <form action="{{ route('users.store') }}" method="POST" class="space-y-0">
                    @csrf

                    @include('users._form', [
                        'button' => 'Create User',
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
                    User role selection will determine access level and available admin actions.
                </p>
            </div>

        </div>
    </div>
@endsection
