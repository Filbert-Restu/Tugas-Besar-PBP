@extends('admin.layouts.admin')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">➕ Add User</h2>

    <div class="bg-white dark:bg-gray-900 shadow-md rounded-lg p-6">
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Name</label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="w-full px-3 py-2 border rounded-lg bg-white text-gray-800 
                              dark:bg-gray-800 dark:text-gray-200 
                              border-gray-300 dark:border-gray-700 
                              focus:ring focus:ring-blue-400" required>
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                       class="w-full px-3 py-2 border rounded-lg bg-white text-gray-800 
                              dark:bg-gray-800 dark:text-gray-200 
                              border-gray-300 dark:border-gray-700 
                              focus:ring focus:ring-blue-400" required>
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Password</label>
                <input type="password" name="password"
                    class="w-full px-3 py-2 border rounded-lg 
                            bg-white text-gray-800 
                            dark:bg-gray-800 dark:text-gray-200 
                            border-gray-300 dark:border-gray-700 
                            focus:ring focus:ring-blue-400"
                    placeholder="Enter password">
            </div>

            <!-- Is Admin -->
            <div class="mb-6 flex items-center gap-2">
                <!-- hidden untuk default 0 -->
                <input type="hidden" name="is_admin" value="0">
                <input type="checkbox" name="is_admin" value="1"
                    class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                    {{ old('is_admin', $user->is_admin ?? false) ? 'checked' : '' }}>
                <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Admin?</label>
            </div>

            <!-- Buttons -->
            <div class="flex items-center gap-3">
                <button type="submit"
                        class="px-5 py-2 text-white font-semibold bg-blue-600 rounded-lg hover:bg-blue-700">
                    Save
                </button>
                <a href="{{ route('admin.users.index') }}"
                   class="px-5 py-2 font-semibold text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 
                          dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
