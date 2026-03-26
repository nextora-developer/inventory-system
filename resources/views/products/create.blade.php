@extends('layouts.admin')

@section('page-title', 'Create Product')

@section('content')
    <div class="mx-auto max-w-5xl rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="mb-6">
            <h2 class="text-xl font-bold text-slate-900">Add New Product</h2>
            <p class="mt-1 text-sm text-slate-500">Create a product for inventory tracking.</p>
        </div>

        <form action="{{ route('products.store') }}" method="POST">
            @include('products._form', ['button' => 'Create Product'])
        </form>
    </div>
@endsection
