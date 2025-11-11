@extends('admin.layout')

@section('title', 'View Message')

@section('content')
<div class="p-6 bg-white shadow rounded-lg">
    <h2 class="text-2xl font-semibold mb-4">Message Details</h2>

    <div class="mb-4">
        <p><strong>Name:</strong> {{ $contact->name }}</p>
        <p><strong>Email:</strong> {{ $contact->email }}</p>
        <p class="mt-2"><strong>Message:</strong></p>
        <p class="text-gray-700">{{ $contact->message }}</p>
    </div>

    <div class="flex gap-3">
        <a href="{{ route('admin.contacts.index') }}" class="bg-gray-500 text-white px-3 py-2 rounded">Back</a>

        <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message?')">
            @csrf
            @method('DELETE')
            <button class="bg-red-600 text-white px-3 py-2 rounded">Delete</button>
        </form>
    </div>
</div>
@endsection
