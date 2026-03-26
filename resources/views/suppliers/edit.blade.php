@extends('layouts.admin')

@section('page-title', 'Edit Supplier')

@section('content')
    <div class="mx-auto max-w-4xl rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="mb-6">
            <h2 class="text-xl font-bold text-slate-900">Edit Supplier</h2>
            <p class="mt-1 text-sm text-slate-500">Update supplier information.</p>
        </div>

        <form action="{{ route('suppliers.update', $supplier) }}" method="POST">
            @method('PUT')
            @include('suppliers._form', [
                'button' => 'Update Supplier',
                'supplier' => $supplier
            ])
        </form>
    </div>
@endsection