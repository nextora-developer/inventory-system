@extends('layouts.admin')

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
                'category' => $category
            ])
        </form>
    </div>
@endsection