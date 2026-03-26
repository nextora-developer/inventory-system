@extends('layouts.admin')

@section('page-title', 'Create Supplier')

@section('content')
    <div class="mx-auto max-w-4xl">

        {{-- Breadcrumb --}}
        <div class="mb-6 flex items-center justify-between">
            <nav class="flex items-center gap-2 text-sm font-medium">
                <a href="{{ route('suppliers.index') }}" class="text-slate-500 transition-colors hover:text-[#8b5cf6]">
                    Suppliers
                </a>

                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-300" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                </svg>

                <span class="text-slate-900">New Supplier</span>
            </nav>

            <a href="{{ route('suppliers.index') }}"
                class="group inline-flex items-center gap-2 text-sm font-bold text-slate-500 transition-colors hover:text-slate-900">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:-translate-x-1"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Back to List
            </a>
        </div>

        {{-- Card --}}
        <div class="overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-xl shadow-slate-200/50">

            {{-- Gradient Top --}}
            <div class="h-2 bg-gradient-to-r from-[#8b5cf6] via-[#c084fc] to-indigo-500"></div>

            <div class="p-8 lg:p-10">

                {{-- Header --}}
                <div class="mb-10 flex items-start justify-between">
                    <div>
                        <h2 class="text-2xl font-black tracking-tight text-slate-900">
                            Add New Supplier
                        </h2>
                        <p class="mt-2 text-slate-500">
                            Create and manage a supplier profile for purchasing, restocking, and inventory coordination.
                        </p>
                    </div>

                    {{-- Icon --}}
                    <div
                        class="hidden h-14 w-14 items-center justify-center rounded-2xl bg-indigo-50 text-[#8b5cf6] sm:flex">
                                              
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                        </svg>
                    </div>
                </div>

                {{-- Form --}}
                <form action="{{ route('suppliers.store') }}" method="POST" class="space-y-0">
                    @csrf

                    @include('suppliers._form', [
                        'button' => 'Create Supplier',
                    ])
                </form>
            </div>

            {{-- Footer Hint --}}
            <div class="border-t border-slate-100 bg-slate-50 px-8 py-4">
                <p class="flex items-center gap-2 text-xs text-slate-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Supplier contact details can be updated later as your procurement records grow.
                </p>
            </div>

        </div>
    </div>
@endsection
