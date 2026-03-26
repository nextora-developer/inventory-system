@extends('layouts.admin')

@section('page-title', 'Suppliers')

@section('content')
    <div class="rounded-3xl border border-slate-200 bg-white shadow-sm">
        <div class="flex flex-col gap-4 border-b border-slate-200 p-6 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-lg font-bold text-slate-900">Supplier List</h2>
                <p class="mt-1 text-sm text-slate-500">Manage supplier records here.</p>
            </div>

            <a href="{{ route('suppliers.create') }}"
                class="inline-flex items-center rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
                + Add Supplier
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.2em] text-slate-500">#</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Supplier
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Contact
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Status
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Created
                        </th>
                        <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Action
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse ($suppliers as $supplier)
                        <tr class="hover:bg-slate-50/80">
                            <td class="px-6 py-4 text-sm text-slate-500">
                                {{ $loop->iteration + ($suppliers->currentPage() - 1) * $suppliers->perPage() }}
                            </td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-semibold text-slate-900">{{ $supplier->name }}</p>
                                    <p class="mt-1 text-sm text-slate-500">{{ $supplier->email ?: 'No email' }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600">
                                <p>{{ $supplier->contact_person ?: 'No contact person' }}</p>
                                <p class="mt-1 text-slate-500">{{ $supplier->phone ?: 'No phone' }}</p>
                            </td>
                            <td class="px-6 py-4">
                                @if ($supplier->is_active)
                                    <span
                                        class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">
                                        Active
                                    </span>
                                @else
                                    <span class="rounded-full bg-rose-100 px-3 py-1 text-xs font-semibold text-rose-700">
                                        Inactive
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-500">{{ $supplier->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('suppliers.edit', $supplier) }}"
                                        class="rounded-xl border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                                        Edit
                                    </a>

                                    <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST"
                                        onsubmit="return confirm('Delete this supplier?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="rounded-xl border border-rose-200 bg-rose-50 px-4 py-2 text-sm font-semibold text-rose-600 transition hover:bg-rose-100">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-sm text-slate-500">
                                No suppliers found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($suppliers->hasPages())
            <div class="border-t border-slate-200 p-6">
                {{ $suppliers->links() }}
            </div>
        @endif
    </div>
@endsection
