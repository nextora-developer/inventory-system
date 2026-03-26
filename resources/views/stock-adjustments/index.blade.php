@extends('layouts.admin')

@section('page-title', 'Stock Adjustments')

@section('content')
    <div class="rounded-3xl border border-slate-100 bg-white shadow-sm overflow-hidden">

        {{-- Header --}}
        <div class="flex flex-col gap-4 border-b border-slate-100 p-6 md:flex-row md:items-center md:justify-between bg-white">
            <div>
                <h2 class="text-xl font-bold text-slate-900">Stock Adjustment Log</h2>
                <p class="mt-1 text-sm text-slate-500">Track and audit all manual inventory changes.</p>
            </div>

            <a href="{{ route('stock-adjustments.create') }}"
                class="group inline-flex items-center gap-2 rounded-2xl bg-[#8b5cf6] px-6 py-3 text-sm font-bold text-white transition-all hover:bg-[#7c3aed] hover:shadow-lg hover:shadow-indigo-100 active:scale-95">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 transition-transform group-hover:rotate-90"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>

                New Adjustment
            </a>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-100">

                {{-- Head --}}
                <thead class="bg-slate-50/50">
                    <tr>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-400">Date</th>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-400">Product</th>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-400">Old</th>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-400">New</th>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-400">Change</th>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-400">Reason</th>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-400">By</th>
                    </tr>
                </thead>

                {{-- Body --}}
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse ($adjustments as $adjustment)
                        <tr class="group transition-all hover:bg-slate-50/50">

                            {{-- Date --}}
                            <td class="px-6 py-4 text-sm text-slate-500 font-medium">
                                {{ $adjustment->created_at->format('d M, Y') }}
                                <p class="text-xs text-slate-400">
                                    {{ $adjustment->created_at->format('H:i') }}
                                </p>
                            </td>

                            {{-- Product --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">

                                    {{-- Icon --}}
                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-slate-500 group-hover:bg-indigo-50 group-hover:text-[#8b5cf6] transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M20 13V7a2 2 0 00-2-2H6a2 2 0 00-2 2v6m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0H4" />
                                        </svg>
                                    </div>

                                    <div>
                                        <p class="font-bold text-slate-900">
                                            {{ $adjustment->product?->name ?? 'Deleted Product' }}
                                        </p>
                                        <p class="mt-0.5 text-xs text-slate-400">
                                            {{ $adjustment->product?->sku ?? '-' }}
                                        </p>
                                    </div>
                                </div>
                            </td>

                            {{-- Old --}}
                            <td class="px-6 py-4 text-sm font-medium text-slate-500">
                                {{ $adjustment->old_quantity }}
                            </td>

                            {{-- New --}}
                            <td class="px-6 py-4 text-sm font-medium text-slate-900">
                                {{ $adjustment->new_quantity }}
                            </td>

                            {{-- Change --}}
                            <td class="px-6 py-4">
                                @if($adjustment->difference > 0)
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1 text-[11px] font-bold text-emerald-700 ring-1 ring-inset ring-emerald-600/20">
                                        +{{ $adjustment->difference }}
                                    </span>
                                @elseif($adjustment->difference < 0)
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-rose-50 px-3 py-1 text-[11px] font-bold text-rose-600 ring-1 ring-inset ring-rose-500/20">
                                        {{ $adjustment->difference }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-3 py-1 text-[11px] font-bold text-slate-600 ring-1 ring-inset ring-slate-400/20">
                                        0
                                    </span>
                                @endif
                            </td>

                            {{-- Reason --}}
                            <td class="px-6 py-4 text-sm text-slate-500 max-w-[200px]">
                                <p class="line-clamp-2">
                                    {{ $adjustment->reason ?: 'No reason provided.' }}
                                </p>
                            </td>

                            {{-- User --}}
                            <td class="px-6 py-4 text-sm text-slate-600 font-medium">
                                {{ $adjustment->user?->name ?? '-' }}
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-20 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="h-16 w-16 rounded-full bg-slate-50 flex items-center justify-center text-slate-300 mb-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3 7h18M3 12h18M3 17h18" />
                                        </svg>
                                    </div>
                                    <p class="text-slate-500 font-medium">No stock adjustments recorded.</p>
                                    <a href="{{ route('stock-adjustments.create') }}"
                                        class="mt-2 text-sm text-[#8b5cf6] font-bold hover:underline">
                                        Create first adjustment →
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        {{-- Pagination --}}
        @if ($adjustments->hasPages())
            <div class="border-t border-slate-100 bg-slate-50/30 px-6 py-4">
                {{ $adjustments->links() }}
            </div>
        @endif

    </div>
@endsection