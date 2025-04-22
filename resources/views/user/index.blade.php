@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
        <div
            class="bg-gradient-to-br from-pink-100 via-yellow-100 to-blue-100 dark:from-pink-900 dark:via-yellow-900 dark:to-blue-900 shadow-xl rounded-2xl overflow-hidden">
            <div class="bg-pink-500 text-white px-6 py-4 rounded-t-2xl">
                <h1 class="text-2xl font-semibold">👤 DAFTAR PENGGUNA</h1>
            </div>

            <div class="px-6 py-4">
                <a href="{{ route('user.create') }}"
                    class="inline-block bg-yellow-400 hover:bg-yellow-500 text-white font-semibold py-2 px-6 rounded-lg mb-4 transition duration-300 transform hover:scale-105">
                    + Tambah Pengguna
                </a>

                @if (session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-lg shadow">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table
                        class="min-w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-xl">
                        <thead
                            class="bg-pink-200 dark:bg-pink-700 text-gray-700 dark:text-white text-sm uppercase rounded-t-xl">
                            <tr>
                                <th class="text-left px-6 py-3 border-b">Nama</th>
                                <th class="text-left px-6 py-3 border-b">Email</th>
                                <th class="text-left px-6 py-3 border-b">Role</th>
                                <th class="text-left px-6 py-3 border-b">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 dark:text-gray-200">
                            @forelse ($users as $user)
                                <tr
                                    class="hover:bg-yellow-50 dark:hover:bg-yellow-800 transition transform hover:scale-105">
                                    <td class="px-6 py-4 border-b">{{ $user->name }}</td>
                                    <td class="px-6 py-4 border-b">{{ $user->email }}</td>
                                    <td class="px-6 py-4 border-b capitalize">
                                        <span
                                            class="inline-block px-3 py-1 rounded-full text-sm font-medium 
                                        {{ $user->role == 'admin' ? 'bg-green-200 text-green-800' : 'bg-blue-200 text-blue-800' }}">
                                            {{ $user->role }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 border-b">
                                        <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="inline"
                                            onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 font-semibold">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                        Tidak ada pengguna terdaftar.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Paginate -->
                <div class="mt-4">
                    {{ $users->links('pagination::tailwind') }}
                </div>
            </div>
        </div>
    </div>
@endsection
