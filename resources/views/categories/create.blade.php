@extends('layouts.admin')

@section('page-title', 'Create Category')

@section('content')
    <div class="mx-auto max-w-3xl rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="mb-6">
            <h2 class="text-xl font-bold text-slate-900">Add New Category</h2>
            <p class="mt-1 text-sm text-slate-500">Create a new category for your inventory items.</p>
        </div>

        <form action="{{ route('categories.store') }}" method="POST">
            @include('categories._form', ['button' => 'Create Category'])
        </form>
    </div>
@endsection