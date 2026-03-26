@extends('layouts.admin')

@section('page-title', 'Suppliers')

@section('content')
    <div class="rounded-3xl border border-slate-100 bg-white shadow-sm overflow-hidden">
        
        {{-- Header --}}
        <div class="flex flex-col gap-4 border-b border-slate-100 p-6 md:flex-row md:items-center md:justify-between bg-white">
            <div>
                <h2 class="text-xl font-bold text-slate-900">Supplier Registry</h2>
                <p class="mt-1 text-sm text-slate-500">Manage and monitor supplier relationships.</p>
            </div>

            <a href="{{ route('suppliers.create') }}"
                class="group inline-flex items-center gap-2 rounded-2xl bg-[#8b5cf6] px-6 py-3 text-sm font-bold text-white transition-all hover:bg-[#7c3aed] hover:shadow-lg hover:shadow-indigo-100 active:scale-95">
                
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform group-hover:rotate-90"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>

                Create Supplier
            </a>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-100">
                
                {{-- Head --}}
                <thead class="bg-slate-50/50">
                    <tr>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-400">No</th>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-400">Supplier</th>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-400">Contact</th>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-400">Status</th>
                        <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[0.15em] text-slate-400">Registry Date</th>
                        <th class="px-6 py-4 text-right text-[11px] font-bold uppercase tracking-[0.15em] text-slate-400">Action</th>
                    </tr>
                </thead>

                {{-- Body --}}
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse ($suppliers as $supplier)
                        <tr class="group transition-all hover:bg-slate-50/50">
                            
                            {{-- No --}}
                            <td class="px-6 py-4 text-sm font-mono text-slate-400">
                                #{{ str_pad($loop->iteration + ($suppliers->currentPage() - 1) * $suppliers->perPage(), 2, '0', STR_PAD_LEFT) }}
                            </td>

                            {{-- Supplier --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    
                                    {{-- Icon --}}
                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-slate-500 group-hover:bg-indigo-50 group-hover:text-[#8b5cf6] transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3 7h18M3 12h18M3 17h18" />
                                        </svg>
                                    </div>

                                    {{-- Info --}}
                                    <div>
                                        <p class="font-bold text-slate-900">{{ $supplier->name }}</p>
                                        <p class="mt-0.5 text-xs text-slate-400">
                                            {{ $supplier->email ?: 'No email provided.' }}
                                        </p>
                                    </div>
                                </div>
                            </td>

                            {{-- Contact --}}
                            <td class="px-6 py-4 text-sm text-slate-600">
                                <p>{{ $supplier->contact_person ?: 'No contact person' }}</p>
                                <p class="mt-0.5 text-xs text-slate-400">{{ $supplier->phone ?: 'No phone' }}</p>
                            </td>

                            {{-- Status --}}
                            <td class="px-6 py-4">
                                @if ($supplier->is_active)
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1 text-[11px] font-bold text-emerald-700 ring-1 ring-inset ring-emerald-600/20">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                        Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-3 py-1 text-[11px] font-bold text-slate-600 ring-1 ring-inset ring-slate-400/20">
                                        <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>
                                        Disabled
                                    </span>
                                @endif
                            </td>

                            {{-- Date --}}
                            <td class="px-6 py-4 text-sm text-slate-500 font-medium">
                                {{ $supplier->created_at->format('d M, Y') }}
                            </td>

                            {{-- Actions --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-3">
                                    
                                    {{-- Edit --}}
                                    <a href="{{ route('suppliers.edit', $supplier) }}"
                                        class="p-2 text-slate-400 hover:text-[#8b5cf6] hover:bg-indigo-50 rounded-lg transition-all"
                                        title="Edit Supplier">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>

                                    {{-- Delete --}}
                                    <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST"
                                        onsubmit="return confirm('Archive this supplier?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-all"
                                            title="Delete Supplier">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-20 text-center">
                                <p class="text-slate-500 font-medium">No suppliers registered yet.</p>
                                <a href="{{ route('suppliers.create') }}"
                                    class="mt-2 inline-block text-sm text-[#8b5cf6] font-bold hover:underline">
                                    Create first supplier →
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        {{-- Pagination --}}
        @if ($suppliers->hasPages())
            <div class="border-t border-slate-100 bg-slate-50/30 px-6 py-4">
                {{ $suppliers->links() }}
            </div>
        @endif

    </div>
@endsection