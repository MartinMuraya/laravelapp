@extends('admin.layout')

@section('title', 'Messages')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-semibold mb-4">Messages</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-100 text-gray-600">
                <tr>
                    <th class="px-4 py-2 text-left">Name</th>
                    <th class="px-4 py-2 text-left">Email</th>
                    <th class="px-4 py-2 text-left">Message</th>
                    <th class="px-4 py-2 text-left">Date</th>
                    <th class="px-4 py-2 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $msg)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $msg->name }}</td>
                    <td class="px-4 py-2">{{ $msg->email }}</td>
                    <td class="px-4 py-2 truncate max-w-xs">{{ Str::limit($msg->message, 50) }}</td>
                    <td class="px-4 py-2">{{ $msg->created_at->format('M d, Y') }}</td>
                    <td class="px-4 py-2 text-right">
                        <a href="{{ route('admin.contacts.show', $msg->id) }}" class="text-blue-600 hover:underline">View</a>
                        <form action="{{ route('admin.contacts.destroy', $msg->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Delete this message?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-4 py-3 text-center text-gray-500">No messages found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $messages->links() }}
    </div>
</div>
@endsection
