@extends('admin.layout')

@section('title', 'Contact Messages')

@section('content')
<div class="max-w-6xl mx-auto bg-white dark:bg-gray-800 p-6 rounded-xl shadow">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-100">Contact Messages</h2>

    @if($messages->count())
        <div class="overflow-x-auto">
            <table class="w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-gray-100 dark:bg-gray-700">
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Message</th>
                        <th class="px-4 py-2">Received At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($messages as $msg)
                    <tr class="border-b dark:border-gray-700">
                        <td class="px-4 py-2">{{ $msg->name }}</td>
                        <td class="px-4 py-2">{{ $msg->email }}</td>
                        <td class="px-4 py-2">{{ $msg->message }}</td>
                        <td class="px-4 py-2">{{ $msg->created_at->format('d M Y, H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $messages->links() }}
        </div>
    @else
        <p class="text-gray-600 dark:text-gray-300">No messages yet.</p>
    @endif
</div>
@endsection
