@extends('admin.layout')

@section('title', 'Add New User')

@section('content')
<div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 p-8 rounded-xl shadow">
    <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100 mb-6">Add New User</h2>

    @if ($errors->any())
        <div class="mb-4 bg-red-100 text-red-700 px-4 py-2 rounded-lg">
            <ul class="list-disc ml-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-5">
        @csrf

        <div>
            <label class="block text-gray-700 dark:text-gray-300 mb-1 font-medium">Full Name</label>
            <input type="text" name="name" value="{{ old('name') }}"
                class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
        </div>

        <div>
            <label class="block text-gray-700 dark:text-gray-300 mb-1 font-medium">Email Address</label>
            <input type="email" name="email" value="{{ old('email') }}"
                class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
        </div>

        <div>
            <label class="block text-gray-700 dark:text-gray-300 mb-1 font-medium">Password</label>
            <input type="password" name="password"
                class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
        </div>

        <div>
            <label class="block text-gray-700 dark:text-gray-300 mb-1 font-medium">Role</label>
            <select name="role"
                class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                <option value="user" selected>User</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <div class="flex justify-end space-x-4 mt-6">
            <a href="{{ route('admin.users.index') }}"
               class="px-5 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600">
               Cancel
            </a>
            <button type="submit"
                class="px-5 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 shadow">
                Create User
            </button>
        </div>
    </form>
</div>
@endsection