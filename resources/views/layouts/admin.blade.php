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

<body class="h-screen overflow-hidden bg-slate-100 text-slate-900">
    @include('partials.admin-sidebar')

    <div class="md:ml-72 flex h-screen flex-col overflow-hidden">
        <header class="border-b border-slate-200 bg-white px-6 py-4 shrink-0">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-slate-900">
                        @yield('page-title', 'Dashboard')
                    </h1>
                    <p class="mt-1 text-sm text-slate-500">
                        Welcome back, {{ auth()->user()->name }}
                    </p>
                </div>

                <div class="hidden md:flex items-center gap-3">
                    <div class="text-right">
                        <p class="text-sm font-semibold text-slate-900">{{ auth()->user()->name }}</p>
                        <p class="text-xs uppercase tracking-[0.2em] text-slate-400">
                            {{ auth()->user()->role }}
                        </p>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-6 lg:p-10">
            {{-- Success Notification --}}
            @if (session('success'))
                <div
                    class="animate-in fade-in slide-in-from-top-4 duration-500 mb-8 flex items-center gap-4 rounded-[2rem] border border-emerald-100 bg-emerald-50/50 p-2 pr-6 shadow-sm shadow-emerald-100/50">
                    <div
                        class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-white text-emerald-600 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-bold text-emerald-900">Action Successful</p>
                        <p class="text-xs font-medium text-emerald-700/80">{{ session('success') }}</p>
                    </div>
                    <button onclick="this.parentElement.remove()"
                        class="text-emerald-400 hover:text-emerald-600 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            @endif

            {{-- Error Notification --}}
            @if (session('error'))
                <div
                    class="animate-in fade-in slide-in-from-top-4 duration-500 mb-8 flex items-center gap-4 rounded-[2rem] border border-rose-100 bg-rose-50/50 p-2 pr-6 shadow-sm shadow-rose-100/50">
                    <div
                        class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-white text-rose-600 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-bold text-rose-900">System Error</p>
                        <p class="text-xs font-medium text-rose-700/80">{{ session('error') }}</p>
                    </div>
                    <button onclick="this.parentElement.remove()"
                        class="text-rose-400 hover:text-rose-600 transition-colors">
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
