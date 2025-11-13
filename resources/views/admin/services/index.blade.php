@extends('admin.layout')

@section('title', 'Manage Services')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12">
    <h2 class="text-3xl font-bold mb-6">All Services</h2>
    <a href="{{ route('services.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-500 mb-4 inline-block">+ New Service</a>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <table class="w-full table-auto border-collapse border border-gray-300">
        <thead>
            <tr>
                <th class="border px-4 py-2">Title</th>
                <th class="border px-4 py-2">Description</th>
                <th class="border px-4 py-2">Price</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($services as $service)
            <tr>
                <td class="border px-4 py-2">{{ $service->title }}</td>
                <td class="border px-4 py-2">{{ $service->description }}</td>
                <td class="border px-4 py-2">KSh {{ number_format($service->price, 2) }}</td>
                <td class="border px-4 py-2 flex gap-2">
                    <a href="{{ route('services.edit', $service) }}" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-400">Edit</a>
                    <form action="{{ route('services.destroy', $service) }}" method="POST" onsubmit="return confirm('Delete this service?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-2 py-1 rounded hover:bg-red-500">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
