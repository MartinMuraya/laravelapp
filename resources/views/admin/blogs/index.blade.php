@extends('admin.layout')

@section('title', 'Manage Blogs')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold">All Blogs</h2>
        <a href="{{ route('admin.blogs.create') }}" 
           class="bg-indigo-600 text-white px-4 py-2 rounded-lg shadow hover:bg-indigo-500 transition">
           + New Blog
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white dark:bg-gray-800 p-4 rounded shadow">
        <table class="w-full">
            <thead>
                <tr class="text-left border-b border-gray-300 dark:border-gray-700">
                    <th class="py-2">Image</th>
                    <th class="py-2">Title</th>
                    <th class="py-2">Author</th>
                    <th class="py-2">Created At</th>
                    <th class="py-2 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($blogs as $blog)
                    <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <td class="py-2">
                            @if($blog->image)
                                <img src="{{ asset('storage/' . $blog->image) }}" 
                                     alt="{{ $blog->title }}" 
                                     class="w-16 h-16 object-cover rounded-md shadow">
                            @else
                                <span class="text-gray-400 text-sm italic">No image</span>
                            @endif
                        </td>
                        <td class="py-2 font-medium text-gray-800 dark:text-gray-100">{{ $blog->title }}</td>
                        <td class="py-2 text-gray-700 dark:text-gray-300">{{ $blog->user->name }}</td>
                        <td class="py-2 text-gray-600 dark:text-gray-400">{{ $blog->created_at->diffForHumans() }}</td>
                        <td class="py-2 text-right space-x-2">
                            <a href="{{ route('admin.blogs.edit', $blog) }}" 
                               class="text-blue-600 hover:text-blue-800 font-medium">Edit</a>
                            <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button 
                                    class="text-red-600 hover:text-red-800 font-medium" 
                                    onclick="return confirm('Delete this blog?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-4 text-center text-gray-500 dark:text-gray-400">
                            No blogs found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $blogs->links() }}
        </div>
    </div>
@endsection

