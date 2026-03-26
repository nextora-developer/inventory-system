@extends('layouts.admin')

@section('page-title', 'Create User')

@section('content')
    <div class="mx-auto max-w-4xl rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="mb-6">
            <h2 class="text-xl font-bold text-slate-900">Add New User</h2>
            <p class="mt-1 text-sm text-slate-500">Create a new admin panel user and assign role.</p>
        </div>

        <form action="{{ route('users.store') }}" method="POST">
            @include('users._form', ['button' => 'Create User'])
        </form>
    </div>
@endsection