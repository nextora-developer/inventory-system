@extends('layouts.admin')

@section('page-title', 'Edit Product')

@section('content')
    <div class="mx-auto max-w-5xl rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="mb-6">
            <h2 class="text-xl font-bold text-slate-900">Edit Product</h2>
            <p class="mt-1 text-sm text-slate-500">Update product information.</p>
        </div>

        <form action="{{ route('products.update', $product) }}" method="POST">
            @method('PUT')
            @include('products._form', [
                'button' => 'Update Product',
                'product' => $product,
                'categories' => $categories,
            ])
        </form>
    </div>
@endsection