@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow">
            <h2 class="text-lg font-semibold mb-2">Total Blogs</h2>
            <p class="text-3xl font-bold text-indigo-600">{{ $totalBlogs }}</p>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow">
            <h2 class="text-lg font-semibold mb-2">Registered Users</h2>
            <p class="text-3xl font-bold text-indigo-600">{{ $totalUsers }}</p>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow">
            <h2 class="text-lg font-semibold mb-2">New Comments (7 days)</h2>
            <p class="text-3xl font-bold text-indigo-600">{{ $newComments }}</p>
        </div>
    </div>
@endsection
