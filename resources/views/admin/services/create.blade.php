@extends('admin.layout')

@section('title', 'Add New Service')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-200">Add New Service</h2>

    <form action="{{ route('services.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block mb-1 text-gray-700 dark:text-gray-200">Title</label>
            <input type="text" name="title" value="{{ old('title') }}"
                class="w-full p-2 border rounded dark:bg-gray-700 dark:text-white" required>
            @error('title')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1 text-gray-700 dark:text-gray-200">Description</label>
            <textarea name="description" rows="4" 
                class="w-full p-2 border rounded dark:bg-gray-700 dark:text-white" required>{{ old('description') }}</textarea>
            @error('description')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1 text-gray-700 dark:text-gray-200">Price (KSh)</label>
            <input type="number" name="price" value="{{ old('price') }}" step="0.01"
                class="w-full p-2 border rounded dark:bg-gray-700 dark:text-white" required>
            @error('price')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit"
            class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-500 transition">
            Add Service
        </button>
    </form>
</div>
@endsection
