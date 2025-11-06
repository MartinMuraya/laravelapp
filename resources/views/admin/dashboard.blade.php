@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-md hover:shadow-lg transition">
        <h2 class="text-lg font-semibold mb-2 text-gray-700 dark:text-gray-200">Total Blogs</h2>
        <p class="text-3xl font-bold text-indigo-600">{{ $totalBlogs }}</p>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-md hover:shadow-lg transition">
        <h2 class="text-lg font-semibold mb-2 text-gray-700 dark:text-gray-200">Registered Users</h2>
        <p class="text-3xl font-bold text-indigo-600">{{ $totalUsers }}</p>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-md hover:shadow-lg transition">
        <h2 class="text-lg font-semibold mb-2 text-gray-700 dark:text-gray-200">New Comments (7 days)</h2>
        <p class="text-3xl font-bold text-indigo-600">{{ $newComments }}</p>
    </div>
</div>
@endsection
