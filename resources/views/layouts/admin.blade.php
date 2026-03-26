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

        <main class="flex-1 overflow-y-auto p-6">
            @if (session('success'))
                <div
                    class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-800">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>

</html>
