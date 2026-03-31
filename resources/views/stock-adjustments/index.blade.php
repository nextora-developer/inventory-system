@extends('layouts.admin')

@section('page-title', 'Stock Adjustments')

@section('content')
    <div class="overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-sm">

        {{-- Header --}}
        <div
            class="flex flex-col gap-4 border-b border-slate-100 bg-white p-4 md:flex-row md:items-center md:justify-between md:p-6">
            <div>
                <h2 class="text-lg font-bold text-slate-900 md:text-xl">Stock Adjustment Log</h2>
                <p class="mt-1 text-xs text-slate-500 md:text-sm">Track and audit all manual inventory changes.</p>
            </div>

            <a href="{{ route('stock-adjustments.create') }}"
                class="group inline-flex items-center justify-center gap-2 rounded-2xl bg-[#8b5cf6] px-5 py-3 text-sm font-bold text-white transition-all hover:bg-[#7c3aed] hover:shadow-lg hover:shadow-indigo-100 active:scale-95 md:px-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform group-hover:rotate-90"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                New Adjustment
            </a>
        </div>

        {{-- Mobile Card List --}}
        <div class="block md:hidden">
            @forelse ($adjustments as $adjustment)
                <div class="border-b border-slate-100 p-4 last:border-b-0">
                    <div class="flex items-start gap-3">
                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-slate-500">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>

                        <div class="min-w-0 flex-1">
                            <div class="flex items-start justify-between gap-3">
                                <div class="min-w-0">
                                    <p class="text-sm font-bold text-slate-900">
                                        {{ $adjustment->product?->name ?? 'Deleted Product' }}
                                    </p>
                                    <p class="mt-1 text-xs text-slate-400">
                                        {{ $adjustment->product?->sku ?? '-' }}
                                    </p>
                                </div>

                                <div class="shrink-0 text-right">
                                    <p class="text-xs font-medium text-slate-500">
                                        {{ $adjustment->created_at->format('d M, Y') }}
                                    </p>
                                    <p class="mt-1 text-[11px] text-slate-400">
                                        {{ $adjustment->created_at->format('H:i') }}
                                    </p>
                                </div>
                            </div>

                            <div class="mt-3 grid grid-cols-3 gap-3 text-xs">
                                <div class="rounded-2xl bg-slate-50 px-3 py-2">
                                    <p class="font-bold uppercase tracking-wide text-slate-400">Old</p>
                                    <p class="mt-1 font-semibold text-slate-600">{{ $adjustment->old_quantity }}</p>
                                </div>

                                <div class="rounded-2xl bg-slate-50 px-3 py-2">
                                    <p class="font-bold uppercase tracking-wide text-slate-400">New</p>
                                    <p class="mt-1 font-semibold text-slate-900">{{ $adjustment->new_quantity }}</p>
                                </div>

                                <div class="rounded-2xl bg-slate-50 px-3 py-2">
                                    <p class="font-bold uppercase tracking-wide text-slate-400">Change</p>
                                    @if ($adjustment->difference > 0)
                                        <p class="mt-1 font-bold text-emerald-700">+{{ $adjustment->difference }}</p>
                                    @elseif($adjustment->difference < 0)
                                        <p class="mt-1 font-bold text-rose-600">{{ $adjustment->difference }}</p>
                                    @else
                                        <p class="mt-1 font-bold text-slate-600">0</p>
                                    @endif
                                </div>
                            </div>

                            <div class="mt-3 rounded-2xl bg-slate-50 px-3 py-2">
                                <p class="text-[11px] font-bold uppercase tracking-wide text-slate-400">Reason</p>
                                <p class="mt-1 text-xs text-slate-600">
                                    {{ $adjustment->reason ?: 'No reason provided.' }}
                                </p>
                            </div>

                            <div class="mt-3 flex items-center justify-between gap-3">
                                <p class="text-xs font-medium text-slate-500">
                                    By {{ $adjustment->user?->name ?? '-' }}
                                </p>

                                @if ($adjustment->difference > 0)
                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-1 text-[11px] font-bold text-emerald-700 ring-1 ring-inset ring-emerald-600/20">
                                        +{{ $adjustment->difference }}
                                    </span>
                                @elseif($adjustment->difference < 0)
                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-full bg-rose-50 px-2.5 py-1 text-[11px] font-bold text-rose-600 ring-1 ring-inset ring-rose-500/20">
                                        {{ $adjustment->difference }}
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-2.5 py-1 text-[11px] font-bold text-slate-600 ring-1 ring-inset ring-slate-400/20">
                                        0
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="px-6 py-16 text-center">
                    <div class="mb-4 flex justify-center">
                        <div class="flex h-16 w-16 items-center justify-center rounded-full bg-slate-50 text-slate-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                            </svg>
                        </div>
                    </div>
                    <p class="font-medium text-slate-500">No stock adjustments recorded.</p>
                    <a href="{{ route('stock-adjustments.create') }}"
                        class="mt-2 inline-block text-sm font-bold text-[#8b5cf6] hover:underline">
                        Create first adjustment →
                    </a>
                </div>
            @endforelse
        </div>

        {{-- Desktop Table --}}
        <div class="hidden overflow-x-auto md:block">
            <table class="min-w-full divide-y divide-slate-100">
                <thead class="bg-slate-50/50">
                    <tr>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-400">
                            Date</th>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-400">
                            Product</th>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-400">
                            Old</th>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-400">
                            New</th>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-400">
                            Change</th>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-400">
                            Reason</th>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-400">
                            By</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse ($adjustments as $adjustment)
                        <tr class="group transition-all hover:bg-slate-50/50">
                            <td class="px-6 py-4 text-sm font-medium text-slate-500">
                                {{ $adjustment->created_at->format('d M, Y') }}
                                <p class="text-xs text-slate-400">
                                    {{ $adjustment->created_at->format('H:i') }}
                                </p>
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-slate-500 transition-colors group-hover:bg-indigo-50 group-hover:text-[#8b5cf6]">
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
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

                            <td class="px-6 py-4 text-sm font-medium text-slate-500">
                                {{ $adjustment->old_quantity }}
                            </td>

                            <td class="px-6 py-4 text-sm font-medium text-slate-900">
                                {{ $adjustment->new_quantity }}
                            </td>

                            <td class="px-6 py-4">
                                @if ($adjustment->difference > 0)
                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1 text-[11px] font-bold text-emerald-700 ring-1 ring-inset ring-emerald-600/20">
                                        +{{ $adjustment->difference }}
                                    </span>
                                @elseif($adjustment->difference < 0)
                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-full bg-rose-50 px-3 py-1 text-[11px] font-bold text-rose-600 ring-1 ring-inset ring-rose-500/20">
                                        {{ $adjustment->difference }}
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-3 py-1 text-[11px] font-bold text-slate-600 ring-1 ring-inset ring-slate-400/20">
                                        0
                                    </span>
                                @endif
                            </td>

                            <td class="max-w-[200px] px-6 py-4 text-sm text-slate-500">
                                <p class="line-clamp-2">
                                    {{ $adjustment->reason ?: 'No reason provided.' }}
                                </p>
                            </td>

                            <td class="px-6 py-4 text-sm font-medium text-slate-600">
                                {{ $adjustment->user?->name ?? '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-20 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div
                                        class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-slate-50 text-slate-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                        </svg>
                                    </div>
                                    <p class="font-medium text-slate-500">No stock adjustments recorded.</p>
                                    <a href="{{ route('stock-adjustments.create') }}"
                                        class="mt-2 text-sm font-bold text-[#8b5cf6] hover:underline">
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
            <div class="border-t border-slate-100 bg-slate-50/30 px-4 py-4 md:px-6">
                <x-pagination :paginator="$adjustments" />
            </div>
        @endif

    </div>
@endsection
