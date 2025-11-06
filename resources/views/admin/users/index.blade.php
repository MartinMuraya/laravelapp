@extends('admin.layout')

@section('title', 'Manage Users')

@section('content')
<div class="flex justify-between items-center mb-6">
  <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">All Users</h2>

  <a href="{{ route('admin.users.create') }}"
     class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow">
     + Add User
  </a>
</div>

@if(session('success'))
  <div class="mb-4 bg-green-100 text-green-800 px-4 py-2 rounded-lg">
    {{ session('success') }}
  </div>
@endif

@if(session('error'))
  <div class="mb-4 bg-red-100 text-red-800 px-4 py-2 rounded-lg">
    {{ session('error') }}
  </div>
@endif

@if($users->count())
  <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-xl shadow">
    <table class="min-w-full text-left">
      <thead class="bg-gray-100 dark:bg-gray-700">
        <tr>
          <th class="px-4 py-3">#</th>
          <th class="px-4 py-3">Name</th>
          <th class="px-4 py-3">Email</th>
          <th class="px-4 py-3">Role</th>
          <th class="px-4 py-3 text-right">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
          <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
            <td class="px-4 py-3">{{ $loop->iteration }}</td>
            <td class="px-4 py-3">{{ $user->name }}</td>
            <td class="px-4 py-3">{{ $user->email }}</td>
            <td class="px-4 py-3">
              <span class="px-2 py-1 rounded-full text-xs font-medium
                {{ $user->role === 'admin'
                    ? 'bg-indigo-100 text-indigo-700 dark:bg-indigo-700 dark:text-white'
                    : 'bg-gray-100 text-gray-700 dark:bg-gray-600 dark:text-gray-200' }}">
                {{ ucfirst($user->role) }}
              </span>
            </td>
            <td class="px-4 py-3 text-right space-x-3">
              <a href="{{ route('admin.users.edit', $user) }}" class="text-yellow-500 hover:underline">Edit</a>

              <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline"
                    onsubmit="return confirm('Delete this user?')">
                @csrf @method('DELETE')
                <button type="submit" class="text-red-500 hover:underline">Delete</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div class="mt-6">{{ $users->links() }}</div>
@else
  <p class="text-gray-500">No users found.</p>
@endif
@endsection
