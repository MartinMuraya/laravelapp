@extends('layouts.app')

@section('content')
<section class="py-16 bg-gray-50 dark:bg-gray-900">
  <div class="max-w-3xl mx-auto px-6">
    <h1 class="text-3xl font-bold mb-6 text-gray-800 dark:text-gray-100">Create New Blog</h1>

    <form action="{{ route('user.blogs.store') }}" method="POST" class="space-y-6">
      @csrf

      <div>
        <label class="block mb-2 text-gray-700 dark:text-gray-300">Title</label>
        <input type="text" name="title" value="{{ old('title') }}"
               class="w-full rounded-lg border-gray-300 dark:bg-gray-800 dark:border-gray-700" required>
      </div>

      <div>
        <label class="block mb-2 text-gray-700 dark:text-gray-300">Content</label>
        <textarea name="content" rows="6"
                  class="w-full rounded-lg border-gray-300 dark:bg-gray-800 dark:border-gray-700" required>{{ old('content') }}</textarea>
      </div>

      <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-xl hover:bg-blue-700">
        Create Blog
      </button>
    </form>
  </div>
</section>
@endsection
