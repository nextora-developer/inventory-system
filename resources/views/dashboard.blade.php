@extends('layouts.admin')

@section('page-title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <p class="text-sm font-medium text-slate-500">Total Products</p>
            <h3 class="mt-3 text-3xl font-black text-slate-900">{{ $totalProducts }}</h3>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <p class="text-sm font-medium text-slate-500">Total Categories</p>
            <h3 class="mt-3 text-3xl font-black text-slate-900">{{ $totalCategories }}</h3>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <p class="text-sm font-medium text-slate-500">Total Suppliers</p>
            <h3 class="mt-3 text-3xl font-black text-slate-900">{{ $totalSuppliers }}</h3>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <p class="text-sm font-medium text-slate-500">Low Stock Items</p>
            <h3 class="mt-3 text-3xl font-black text-rose-600">{{ $lowStockCount }}</h3>
        </div>
    </div>

    <div class="mt-6 grid grid-cols-1 gap-6 xl:grid-cols-3">
        <div class="xl:col-span-2 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold text-slate-900">Today Overview</h3>
                    <p class="mt-1 text-sm text-slate-500">Live summary for today.</p>
                </div>
            </div>

            <div class="mt-6 grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="rounded-2xl bg-slate-50 p-5">
                    <p class="text-sm font-medium text-slate-500">Stock In Today</p>
                    <p class="mt-2 text-2xl font-bold text-emerald-600">{{ $stockInToday }}</p>
                </div>

                <div class="rounded-2xl bg-slate-50 p-5">
                    <p class="text-sm font-medium text-slate-500">Stock Out Today</p>
                    <p class="mt-2 text-2xl font-bold text-rose-600">{{ $stockOutToday }}</p>
                </div>

                <div class="rounded-2xl bg-slate-50 p-5">
                    <p class="text-sm font-medium text-slate-500">Adjustments Today</p>
                    <p class="mt-2 text-2xl font-bold text-slate-900">{{ $todayAdjustments }}</p>
                </div>

                <div class="rounded-2xl bg-slate-50 p-5">
                    <p class="text-sm font-medium text-slate-500">Active Users</p>
                    <p class="mt-2 text-2xl font-bold text-slate-900">{{ $activeUsers }}</p>
                </div>
            </div>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <h3 class="text-lg font-bold text-slate-900">Quick Actions</h3>
            <p class="mt-1 text-sm text-slate-500">Common shortcuts for daily tasks.</p>

            <div class="mt-6 space-y-3">
                @if(in_array(auth()->user()->role, ['admin', 'manager']))
                    <a href="{{ route('products.index') }}"
                       class="block rounded-2xl bg-slate-900 px-4 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
                        Manage Products
                    </a>
                @endif

                @if(in_array(auth()->user()->role, ['admin', 'manager', 'staff', 'storekeeper']))
                    <a href="{{ route('stock.in') }}"
                       class="block rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-900 transition hover:bg-slate-50">
                        Create Stock In
                    </a>

                    <a href="{{ route('stock.out') }}"
                       class="block rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-900 transition hover:bg-slate-50">
                        Create Stock Out
                    </a>
                @endif

                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('stock-adjustments.index') }}"
                       class="block rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-900 transition hover:bg-slate-50">
                        Stock Adjustments
                    </a>
                @endif
            </div>
        </div>
    </div>

    <div class="mt-6 rounded-3xl border border-slate-200 bg-white shadow-sm">
        <div class="border-b border-slate-200 p-6">
            <h3 class="text-lg font-bold text-slate-900">Recent Transactions</h3>
            <p class="mt-1 text-sm text-slate-500">Latest stock movements in the system.</p>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Date</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Product</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Type</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Qty</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Reference</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.2em] text-slate-500">By</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse ($recentTransactions as $transaction)
                        <tr class="hover:bg-slate-50/80">
                            <td class="px-6 py-4 text-sm text-slate-500">
                                {{ $transaction->transaction_date?->format('d M Y') ?? '-' }}
                            </td>

                            <td class="px-6 py-4">
                                <p class="font-semibold text-slate-900">{{ $transaction->product?->name ?? '-' }}</p>
                                <p class="mt-1 text-sm text-slate-500">{{ $transaction->product?->sku ?? '-' }}</p>
                            </td>

                            <td class="px-6 py-4">
                                @php
                                    $type = $transaction->type;
                                @endphp

                                @if($type === 'in')
                                    <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">Stock In</span>
                                @elseif($type === 'out')
                                    <span class="rounded-full bg-rose-100 px-3 py-1 text-xs font-semibold text-rose-700">Stock Out</span>
                                @elseif($type === 'adjustment_plus')
                                    <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">Adjustment +</span>
                                @else
                                    <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-700">Adjustment -</span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-sm font-semibold text-slate-900">
                                {{ $transaction->quantity }}
                            </td>

                            <td class="px-6 py-4 text-sm text-slate-500">
                                {{ $transaction->reference_no ?? '-' }}
                            </td>

                            <td class="px-6 py-4 text-sm text-slate-500">
                                {{ $transaction->user?->name ?? '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-sm text-slate-500">
                                No recent transactions yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection