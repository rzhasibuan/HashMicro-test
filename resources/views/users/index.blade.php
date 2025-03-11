<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Management User') }}
        </h2>
    </x-slot>
    <div class="max-w-6xl mx-auto p-6 bg-white shadow-md rounded-lg my-5">

        @if (session('success'))
        <div class="bg-green-500 text-white p-3 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">Daftar User</h3>
            <a href="{{ route('users.create') }}" class="bg-green-500 text-white px-4 py-2 rounded">Tambah User</a>
        </div>

        <table class="w-full border-collapse border border-gray-300">
            <thead>
            <tr class="bg-gray-200">
                <th class="border p-2">Nama</th>
                <th class="border p-2">Email</th>
                <th class="border p-2">Aksi</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
            <tr class="text-center">
                <td class="border p-2">{{ $user->name }}</td>
                <td class="border p-2">{{ $user->email }}</td>
                <td class="border p-2">
                    <a href="{{ route('users.edit', $user) }}" class="text-blue-500">Edit</a>
                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-500 ml-2">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
