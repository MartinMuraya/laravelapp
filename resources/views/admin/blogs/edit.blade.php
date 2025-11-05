@extends('admin.layout')

@section('title', 'Edit Blog')

@section('content')
    <form action="{{ route('admin.blogs.update', $blog) }}" 
          method="POST" 
          enctype="multipart/form-data" 
          class="bg-white dark:bg-gray-800 p-6 rounded shadow">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-semibold mb-1">Title</label>
            <input type="text" 
                   name="title" 
                   class="w-full border-gray-300 rounded p-2" 
                   value="{{ old('title', $blog->title) }}" 
                   required>
            @error('title') 
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p> 
            @enderror
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Content</label>
            <textarea name="content" rows="6" 
                      class="w-full border-gray-300 rounded p-2" required>{{ old('content', $blog->content) }}</textarea>
            @error('content') 
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p> 
            @enderror
        </div>

        {{-- ✅ Current image preview --}}
        @if ($blog->image)
            <div class="mb-4">
                <label class="block font-semibold mb-1">Current Image</label>
                <img src="{{ asset('storage/' . $blog->image) }}" 
                     alt="Blog image" 
                     class="w-48 h-32 object-cover rounded shadow border">
            </div>
        @endif

        {{-- ✅ Upload new image --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">Change Image (optional)</label>
            <input type="file" name="image" accept="image/*" 
                   class="w-full border-gray-300 rounded p-2">
            @error('image') 
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p> 
            @enderror
        </div>

        <button class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-500">
            Update Blog
        </button>
    </form>
@endsection