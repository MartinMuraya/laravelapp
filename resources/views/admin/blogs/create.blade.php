@extends('admin.layout')

@section('title', 'Create Blog')

@section('content')
    <form action="{{ route('admin.blogs.store') }}" 
          method="POST" 
          enctype="multipart/form-data" 
          class="bg-white dark:bg-gray-800 p-6 rounded shadow">
        @csrf

        <div class="mb-4">
            <label class="block font-semibold mb-1">Title</label>
            <input type="text" name="title" 
                   class="w-full border-gray-300 rounded p-2" 
                   value="{{ old('title') }}" required>
            @error('title') 
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p> 
            @enderror
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Content</label>
            <textarea name="content" rows="6" 
                      class="w-full border-gray-300 rounded p-2" required>{{ old('content') }}</textarea>
            @error('content') 
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p> 
            @enderror
        </div>

        {{-- ✅ Image upload field --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">Cover Image (optional)</label>
            <input type="file" name="image" accept="image/*" 
                   class="w-full border-gray-300 rounded p-2">
            @error('image') 
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p> 
            @enderror
        </div>

        <button class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-500">
            Create Blog
        </button>
    </form>
@endsection
