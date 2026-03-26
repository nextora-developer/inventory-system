@extends('layouts.admin')

@section('page-title', 'Dashboard')

@section('content')

    {{-- 📊 SECTION: TOP OVERVIEW CARDS --}}
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-4">

        <div
            class="relative overflow-hidden rounded-3xl border border-slate-100 bg-white p-6 shadow-sm transition-all hover:shadow-md">
            <div class="absolute -right-4 -top-4 h-24 w-24 rounded-full bg-indigo-50/50"></div>
            <div class="flex items-center gap-4">
                <div
                    class="relative flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-indigo-500 text-white shadow-lg shadow-indigo-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Products</p>
                    <h3 class="mt-1 text-3xl font-black text-slate-900">{{ number_format($totalProducts) }}</h3>
                </div>
            </div>
        </div>

        <div
            class="relative overflow-hidden rounded-3xl border border-slate-100 bg-white p-6 shadow-sm transition-all hover:shadow-md">
            <div class="absolute -right-4 -top-4 h-24 w-24 rounded-full bg-purple-50/50"></div>
            <div class="flex items-center gap-4">
                <div
                    class="relative flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-purple-500 text-white shadow-lg shadow-purple-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Categories</p>
                    <h3 class="mt-1 text-3xl font-black text-slate-900">{{ number_format($totalCategories) }}</h3>
                </div>
            </div>
        </div>

        <div
            class="relative overflow-hidden rounded-3xl border border-slate-100 bg-white p-6 shadow-sm transition-all hover:shadow-md">
            <div class="absolute -right-4 -top-4 h-24 w-24 rounded-full bg-blue-50/50"></div>
            <div class="flex items-center gap-4">
                <div
                    class="relative flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-blue-500 text-white shadow-lg shadow-blue-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Suppliers</p>
                    <h3 class="mt-1 text-3xl font-black text-slate-900">{{ number_format($totalSuppliers) }}</h3>
                </div>
            </div>
        </div>

        <div
            class="relative overflow-hidden rounded-3xl border border-slate-100 bg-white p-6 shadow-sm transition-all hover:shadow-md">
            <div class="absolute -right-4 -top-4 h-24 w-24 rounded-full bg-rose-50/50"></div>
            <div class="flex items-center gap-4">
                <div
                    class="relative flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-rose-500 text-white shadow-lg shadow-rose-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Low Stock</p>
                    <h3 class="mt-1 text-3xl font-black text-rose-600">{{ $lowStockCount }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- 📉 SECTION: OPERATIONAL SPLIT GRID --}}
    <div class="mt-8 grid grid-cols-1 gap-6 xl:grid-cols-3">

        <div class="xl:col-span-2 rounded-3xl border border-slate-100 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold text-slate-900">Today's Overview</h3>
                    <p class="mt-1 text-sm text-slate-500">Live operational summary.</p>
                </div>
                <div class="flex items-center gap-2 rounded-full bg-emerald-50 px-3 py-1 ring-1 ring-emerald-100">
                    <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span class="text-xs font-semibold text-emerald-700">Live Stream</span>
                </div>
            </div>

            <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div class="group rounded-2xl bg-slate-50 p-5 transition-all hover:bg-emerald-500/5">
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-500 group-hover:text-emerald-600">Stock
                        In</p>
                    <p class="mt-2 text-3xl font-black text-slate-900 group-hover:text-emerald-600">{{ $stockInToday }}</p>
                </div>

                <div class="group rounded-2xl bg-slate-50 p-5 transition-all hover:bg-rose-500/5">
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-500 group-hover:text-rose-600">Stock Out
                    </p>
                    <p class="mt-2 text-3xl font-black text-slate-900 group-hover:text-rose-600">{{ $stockOutToday }}</p>
                </div>

                <div class="group rounded-2xl bg-slate-50 p-5 transition-all hover:bg-indigo-500/5">
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-500 group-hover:text-indigo-600">Today's
                        Adjustments</p>
                    <p class="mt-2 text-3xl font-black text-slate-900 group-hover:text-indigo-600">{{ $todayAdjustments }}
                    </p>
                </div>

                <div class="group rounded-2xl bg-slate-50 p-5 transition-all hover:bg-slate-500/5">
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-500 group-hover:text-slate-700">Online
                        Users</p>
                    <p class="mt-2 text-3xl font-black text-slate-900 group-hover:text-slate-700">{{ $activeUsers }}</p>
                </div>
            </div>
        </div>

        <div class="rounded-3xl border border-slate-100 bg-white p-6 shadow-sm">
            <h3 class="text-lg font-bold text-slate-900">System Toolbelt</h3>
            <p class="mt-1 text-sm text-slate-500">Operational shortcuts.</p>

            <div class="mt-6 flex flex-col gap-3">
                @if (in_array(auth()->user()->role, ['admin', 'manager']))
                    <a href="{{ route('products.index') }}"
                        class="group flex items-center justify-between rounded-2xl bg-slate-900 px-5 py-4 text-sm font-bold text-white transition hover:bg-slate-800">
                        <span>Manage Products</span>
                        <svg class="h-4 w-4 transition-transform group-hover:translate-x-1" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                @endif

                @if (in_array(auth()->user()->role, ['admin', 'manager', 'staff', 'storekeeper']))
                    <a href="{{ route('stock.in') }}"
                        class="flex items-center gap-3 rounded-2xl border-2 border-slate-100 bg-white px-5 py-3.5 text-sm font-bold text-slate-700 transition hover:bg-slate-50 hover:border-slate-200">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </div>
                        Stock In
                    </a>

                    <a href="{{ route('stock.out') }}"
                        class="flex items-center gap-3 rounded-2xl border-2 border-slate-100 bg-white px-5 py-3.5 text-sm font-bold text-slate-700 transition hover:bg-slate-50 hover:border-slate-200">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-rose-100 text-rose-600">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 12H4" />
                            </svg>
                        </div>
                        Stock Out
                    </a>
                @endif

                @if (auth()->user()->role === 'admin')
                    <a href="{{ route('stock-adjustments.index') }}"
                        class="flex items-center gap-3 rounded-2xl border-2 border-slate-100 bg-white px-5 py-3.5 text-sm font-bold text-slate-700 transition hover:bg-slate-50 hover:border-slate-200">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-100 text-indigo-600">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        Stock Adjustment
                    </a>
                @endif
            </div>
        </div>
    </div>

    {{-- 📋 SECTION: TRANSACTIONS ARCHIVE --}}
    <div class="mt-8 overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-sm">
        <div class="border-b border-slate-100 p-6">
            <h3 class="text-lg font-bold text-slate-900">Recent Transactions Archive</h3>
            <p class="mt-1 text-sm text-slate-500">Snapshot logs of raw operational movements.</p>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-100">
                <thead class="bg-slate-50/70">
                    <tr>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-500">
                            Timestamps</th>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-500">
                            Material Model</th>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-500">
                            Stream Variant</th>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-500">
                            Vol. Metric</th>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-500">
                            Track ID</th>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-500">
                            Operator</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse ($recentTransactions as $transaction)
                        <tr class="transition hover:bg-slate-50/50">
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-500">
                                {{ $transaction->transaction_date?->format('d M, y') ?? '-' }}
                            </td>

                            <td class="px-6 py-4">
                                <p class="text-sm font-bold text-slate-900">{{ $transaction->product?->name ?? '-' }}</p>
                                <p class="mt-0.5 text-xs text-slate-400 font-mono tracking-tight">
                                    {{ $transaction->product?->sku ?? '-' }}</p>
                            </td>

                            <td class="whitespace-nowrap px-6 py-4">
                                @php
                                    $type = $transaction->type;
                                @endphp

                                @if ($type === 'in')
                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-bold text-emerald-700 ring-1 ring-inset ring-emerald-600/20">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                        Stock Entry
                                    </span>
                                @elseif($type === 'out')
                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-md bg-rose-50 px-2.5 py-1 text-xs font-bold text-rose-700 ring-1 ring-inset ring-rose-600/20">
                                        <span class="h-1.5 w-1.5 rounded-full bg-rose-500"></span>
                                        Stock Exit
                                    </span>
                                @elseif($type === 'adjustment_plus')
                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-md bg-indigo-50 px-2.5 py-1 text-xs font-bold text-indigo-700 ring-1 ring-inset ring-indigo-600/20">
                                        <span class="h-1.5 w-1.5 rounded-full bg-indigo-500"></span>
                                        Adjust Up (+)
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-md bg-amber-50 px-2.5 py-1 text-xs font-bold text-amber-700 ring-1 ring-inset ring-amber-600/20">
                                        <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                        Adjust Down (-)
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-sm font-bold text-slate-900">
                                {{ number_format($transaction->quantity) }}
                            </td>

                            <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-500 font-mono">
                                {{ $transaction->reference_no ?? '-' }}
                            </td>

                            <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-500">
                                {{ $transaction->user?->name ?? '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-sm text-slate-500">
                                No recent logs captured in loop tracking.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
