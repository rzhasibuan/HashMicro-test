<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Management User') }}
        </h2>
    </x-slot>
    <div class="max-w-lg mx-auto p-6 bg-white shadow-md rounded-lg my-5">
        <h2 class="text-xl font-bold mb-4">Edit User</h2>

        <form action="{{ route('users.update', $user) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="block">Nama</label>
                <input type="text" name="name" value="{{ $user->name }}" class="w-full p-2 border rounded" required>
            </div>
            <div class="mb-3">
                <label class="block">Email</label>
                <input type="email" name="email" value="{{ $user->email }}" class="w-full p-2 border rounded" required>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
        </form>
    </div>
</x-app-layout>
