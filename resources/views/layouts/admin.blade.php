<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Inventory Panel' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] {
            display: none !important;
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, #6366f1, #8b5cf6);
            border-radius: 999px;
            box-shadow: 0 0 8px rgba(99, 102, 241, 0.4);
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
    </style>
</head>

<body class="min-h-screen bg-slate-100 text-slate-900" x-data="{ sidebarOpen: false }">

    {{-- Mobile Backdrop --}}
    <div x-show="sidebarOpen" x-cloak x-transition.opacity
        class="fixed inset-0 z-40 bg-slate-900/50 backdrop-blur-sm md:hidden"
        @click="sidebarOpen = false">
    </div>

    {{-- Desktop Sidebar --}}
    <div class="fixed inset-y-0 left-0 z-40 hidden w-72 md:block">
        @include('partials.admin-sidebar')
    </div>

    {{-- Mobile Sidebar --}}
    <div x-show="sidebarOpen" x-cloak
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="fixed inset-y-0 left-0 z-50 w-72 md:hidden">
        @include('partials.admin-sidebar')
    </div>

    {{-- Main Content --}}
    <div class="min-h-screen md:ml-72">
        <header class="sticky top-0 z-30 border-b border-slate-200 bg-white/95 px-4 py-4 backdrop-blur md:px-6">
            <div class="flex items-center justify-between gap-4">
                <div class="flex min-w-0 items-center gap-3">
                    <button type="button"
                        class="inline-flex h-11 w-11 items-center justify-center rounded-2xl border border-slate-200 bg-white text-slate-700 shadow-sm transition hover:bg-slate-50 md:hidden"
                        @click="sidebarOpen = true">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <div class="min-w-0">
                        <h1 class="truncate text-xl font-bold text-slate-900 md:text-2xl">
                            @yield('page-title', 'Dashboard')
                        </h1>
                        <p class="mt-1 truncate text-xs text-slate-500 md:text-sm">
                            Welcome back, {{ auth()->user()->name }}
                        </p>
                    </div>
                </div>

                <div class="flex shrink-0 items-center gap-3">
                    <div class="hidden text-right sm:block">
                        <p class="text-sm font-semibold text-slate-900">{{ auth()->user()->name }}</p>
                        <p class="text-[10px] uppercase tracking-[0.2em] text-slate-400 md:text-xs">
                            {{ auth()->user()->role }}
                        </p>
                    </div>

                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-indigo-500 to-violet-500 text-sm font-bold text-white shadow-lg shadow-indigo-200">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                </div>
            </div>
        </header>

        <main class="px-4 py-5 md:px-6 lg:px-8 lg:py-8">
            @if (session('success'))
                <div
                    class="mb-6 flex items-start gap-3 rounded-3xl border border-emerald-100 bg-emerald-50/80 p-3 shadow-sm shadow-emerald-100/50 md:items-center md:gap-4 md:p-4">
                    <div
                        class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-white text-emerald-600 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-6 md:w-6" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>

                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-bold text-emerald-900">Action Successful</p>
                        <p class="mt-0.5 text-xs font-medium leading-5 text-emerald-700/80 md:text-sm">
                            {{ session('success') }}
                        </p>
                    </div>

                    <button onclick="this.parentElement.remove()"
                        class="mt-0.5 shrink-0 text-emerald-400 transition-colors hover:text-emerald-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            @endif

            @if (session('error'))
                <div
                    class="mb-6 flex items-start gap-3 rounded-3xl border border-rose-100 bg-rose-50/80 p-3 shadow-sm shadow-rose-100/50 md:items-center md:gap-4 md:p-4">
                    <div
                        class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-white text-rose-600 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-6 md:w-6" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>

                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-bold text-rose-900">System Error</p>
                        <p class="mt-0.5 text-xs font-medium leading-5 text-rose-700/80 md:text-sm">
                            {{ session('error') }}
                        </p>
                    </div>

                    <button onclick="this.parentElement.remove()"
                        class="mt-0.5 shrink-0 text-rose-400 transition-colors hover:text-rose-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>

</html>