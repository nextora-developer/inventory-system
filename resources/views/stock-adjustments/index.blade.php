@extends('layouts.admin')

@section('page-title', 'Stock Adjustments')

@section('content')
    <div class="rounded-3xl border border-slate-200 bg-white shadow-sm">
        <div class="flex flex-col gap-4 border-b border-slate-200 p-6 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-lg font-bold text-slate-900">Stock Adjustment History</h2>
                <p class="mt-1 text-sm text-slate-500">Track all manual stock corrections here.</p>
            </div>

            <a href="{{ route('stock-adjustments.create') }}"
                class="inline-flex items-center rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
                + New Adjustment
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Date</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Product</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Old Qty</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.2em] text-slate-500">New Qty</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Difference</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Reason</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.2em] text-slate-500">By</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse ($adjustments as $adjustment)
                        <tr class="hover:bg-slate-50/80">
                            <td class="px-6 py-4 text-sm text-slate-500">
                                {{ $adjustment->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-semibold text-slate-900">{{ $adjustment->product?->name }}</p>
                                <p class="mt-1 text-sm text-slate-500">{{ $adjustment->product?->sku }}</p>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600">{{ $adjustment->old_quantity }}</td>
                            <td class="px-6 py-4 text-sm text-slate-600">{{ $adjustment->new_quantity }}</td>
                            <td class="px-6 py-4">
                                @if($adjustment->difference > 0)
                                    <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">
                                        +{{ $adjustment->difference }}
                                    </span>
                                @elseif($adjustment->difference < 0)
                                    <span class="rounded-full bg-rose-100 px-3 py-1 text-xs font-semibold text-rose-700">
                                        {{ $adjustment->difference }}
                                    </span>
                                @else
                                    <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">
                                        0
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-500">
                                {{ $adjustment->reason ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-500">
                                {{ $adjustment->user?->name ?? '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-10 text-center text-sm text-slate-500">
                                No stock adjustments found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($adjustments->hasPages())
            <div class="border-t border-slate-200 p-6">
                {{ $adjustments->links() }}
            </div>
        @endif
    </div>
@endsection