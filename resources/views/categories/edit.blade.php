{{-- @extends('layouts.admin')

@section('page-title', 'Edit Category')

@section('content')
    <div class="mx-auto max-w-3xl rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="mb-6">
            <h2 class="text-xl font-bold text-slate-900">Edit Category</h2>
            <p class="mt-1 text-sm text-slate-500">Update category information.</p>
        </div>

        <form action="{{ route('categories.update', $category) }}" method="POST">
            @method('PUT')
            @include('categories._form', [
                'button' => 'Update Category',
                'category' => $category,
            ])
        </form>
    </div>
@endsection --}}

@extends('layouts.admin')

@section('page-title', 'Create Category')

@section('content')
    <div class="mx-auto max-w-3xl">

        {{-- Back Link & Breadcrumb --}}
        <div class="mb-6 flex items-center justify-between">
            <nav class="flex items-center gap-2 text-sm font-medium">
                <a href="{{ route('categories.index') }}"
                    class="text-slate-500 hover:text-[#8b5cf6] transition-colors">Categories</a>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-300" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-slate-900">Edit Category</span>
            </nav>

            <a href="{{ route('categories.index') }}"
                class="group inline-flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-slate-900 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:-translate-x-1"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Back to List
            </a>
        </div>

        {{-- Form Card --}}
        <div class="overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-xl shadow-slate-200/50">

            {{-- Visual Header --}}
            <div class="relative h-2 bg-gradient-to-r from-[#8b5cf6] via-[#c084fc] to-indigo-500"></div>

            <div class="p-8 lg:p-10">
                <div class="mb-10 flex items-start justify-between">
                    <div>
                        <h2 class="text-2xl font-black tracking-tight text-slate-900">Edit Category</h2>
                        <p class="mt-2 text-slate-500">
                            Update the details of this category to keep your inventory structure organized and accurate.
                        </p>
                    </div>
                    <div
                        class="hidden sm:flex h-14 w-14 items-center justify-center rounded-2xl bg-indigo-50 text-[#8b5cf6]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                </div>

                <form action="{{ route('categories.update', $category) }}" method="POST" class="space-y-0">
                    @method('PUT')
                    @include('categories._form', [
                        'button' => 'Update Category',
                        'category' => $category,
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
                    All category slugs are automatically generated based on the name if left blank.
                </p>
            </div>
        </div>
    </div>
@endsection
