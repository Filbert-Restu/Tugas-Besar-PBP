@extends('layouts.admin')

@section('content')
    <div class="max-w-7xl mx-auto">
    {{-- Header --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
      <div>
        <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
          <div class="w-10 h-10 bg-gradient-to-br from-green-400 to-emerald-500 rounded-lg flex items-center justify-center">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-4-4h-1m-4 6v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2h9zM9 10a4 4 0 110-8 4 4 0 010 8zm6 0a4 4 0 110-8 4 4 0 010 8z" />
            </svg>
          </div>
          Kelola Pengguna
        </h1>
        <p class="text-gray-500 mt-1">Kelola dan manage pengguna anda</p>
      </div>
      <a href="{{ route('admin.users.create') }}" class="px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 text-white rounded-xl shadow-lg hover:shadow-xl hover:from-green-700 hover:to-emerald-700 transition-all flex items-center gap-2 font-medium">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Tambah Pengguna
      </a>
    </div>

    <!-- Products Table -->
    <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">
      <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="bg-gradient-to-r from-gray-50 to-gray-100">
              <th class="p-5 font-semibold text-gray-700 text-sm">ID</th>
              <th class="p-5 font-semibold text-gray-700 text-sm">NAMA</th>
              <th class="p-5 font-semibold text-gray-700 text-sm">EMAIL</th>
              <th class="p-5 font-semibold text-gray-700 text-sm">ROLE</th>
              <th class="p-5 font-semibold text-gray-700 text-sm">AKSI</th>
            </tr>
          </thead>
          <tbody>
                @forelse ($users as $index => $user)
                    <tr class="border-t hover:bg-green-50">
                        <td class="p-5">{{ $index + 1 }}</td>
                        <td class="p-5">{{ $user->name }}</td>
                        <td class="p-5">{{ $user->email }}</td>
                        <td class="p-5 capitalize">{{ $user->role }}</td>
                        <td class="p-5 flex items-center gap-4">
                          <div class="flex gap-2">
                            <a href="{{ route('admin.users.edit', $user) }}"
                              class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-500 to-indigo-500 text-white rounded-lg hover:from-blue-600 hover:to-indigo-600 transition-all shadow-md hover:shadow-lg">
                              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                              </svg>
                              Edit
                            </a>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" 
                                  onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-4 py-2 bg-gradient-to-r from-red-500 to-pink-500 text-white rounded-lg 
                                          hover:from-red-600 hover:to-pink-600 transition-all shadow-md hover:shadow-lg 
                                          flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                          </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-gray-500">Belum ada data pengguna.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
      </div>
    </div>
</div>
@endsection
