@extends('admin.layouts.admin')

@section('content')
<div class="p-6">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-purple-950">Manage Users</h2>
        <a href="{{ route('admin.users.create') }}"
           class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700">
           + Add User
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 text-sm text-green-700 bg-green-100 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white dark:bg-gray-900 shadow-md rounded-lg">
        <table class="w-full border-collapse">
            <thead class="bg-gray-100 dark:bg-gray-800">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">#</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Name</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Email</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Admin?</th>
                    <th class="px-4 py-3 text-center text-sm font-semibold text-gray-600 dark:text-gray-300">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr class="border-b hover:bg-gray-50 dark:hover:bg-gray-800">
                    <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-200">{{ $loop->iteration }}</td>
                    <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-200">{{ $user->name }}</td>
                    <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-200">{{ $user->email }}</td>
                    <td class="px-4 py-3 text-sm">
                        @if($user->is_admin)
                            <span class="px-2 py-1 text-xs font-medium text-white bg-green-600 rounded">Yes</span>
                        @else
                            <span class="px-2 py-1 text-xs font-medium text-white bg-gray-500 rounded">No</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 flex gap-2 justify-center">
                        <a href="{{ route('admin.users.edit', $user) }}"
                           class="px-3 py-1 text-xs font-semibold text-white bg-yellow-500 rounded hover:bg-yellow-600">
                           Edit
                        </a>
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Delete this user?')">
                            @csrf @method('DELETE')
                            <button type="submit"
                                    class="px-3 py-1 text-xs font-semibold text-white bg-red-600 rounded hover:bg-red-700">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
@endsection
