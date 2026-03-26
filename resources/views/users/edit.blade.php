@extends('layouts.admin')

@section('page-title', 'Edit User')

@section('content')
    <div class="mx-auto max-w-4xl rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="mb-6">
            <h2 class="text-xl font-bold text-slate-900">Edit User</h2>
            <p class="mt-1 text-sm text-slate-500">Update user info, role, or password.</p>
        </div>

        <form action="{{ route('users.update', $user) }}" method="POST">
            @method('PUT')
            @include('users._form', [
                'button' => 'Update User',
                'user' => $user,
                'roles' => $roles,
            ])
        </form>
    </div>
@endsection