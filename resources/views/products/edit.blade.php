@extends('layouts.admin')

@section('page-title', 'Edit Product')

@section('content')
    <div class="mx-auto max-w-5xl">

        {{-- Breadcrumb --}}
        <div class="mb-6 flex items-center justify-between">
            <nav class="flex items-center gap-2 text-sm font-medium">
                <a href="{{ route('products.index') }}" class="text-slate-500 hover:text-[#8b5cf6] transition-colors">
                    Products
                </a>

                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-300" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                </svg>

                <span class="text-slate-900">Edit Product</span>
            </nav>

            <a href="{{ route('products.index') }}"
                class="group inline-flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-slate-900 transition-colors">
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
                            Edit Product
                        </h2>
                        <p class="mt-2 text-slate-500">
                            Modify product details, pricing, and inventory settings.
                        </p>
                    </div>

                    {{-- Icon --}}
                    <div
                        class="hidden sm:flex h-14 w-14 items-center justify-center rounded-2xl bg-indigo-50 text-[#8b5cf6]">
                        <svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                </div>

                {{-- Form --}}
                <form action="{{ route('products.update', $product) }}" method="POST" class="space-y-0">
                    @csrf
                    @method('PUT')

                    @include('products._form', [
                        'button' => 'Update Product',
                        'product' => $product,
                        'categories' => $categories,
                    ])
                </form>
            </div>

            {{-- Footer Hint --}}
            <div class="bg-slate-50 border-t border-slate-100 px-8 py-4">
                <p class="text-xs text-slate-400 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Changes will immediately affect stock tracking and pricing calculations.
                </p>
            </div>

        </div>
    </div>
@endsection
