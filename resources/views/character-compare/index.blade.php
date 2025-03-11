<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Perbandingan Karakter') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 pt-4">
        <div class="max-w-lg mx-auto mt-8 bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg">
            <form action="{{ route('compare.process') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Masukkan Teks Pertama</label>
                    <input type="text" name="character1" class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-400 outline-none" required>
                </div>
                <div>
                    <label class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Masukkan Teks Kedua</label>
                    <input type="text" name="character2" class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-400 outline-none" required>
                </div>
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition duration-300 ease-in-out shadow-md">
                    Bandingkan Karakter
                </button>
            </form>

            @isset($percentage)
            <div class="mt-6 p-4 bg-green-100 border border-green-400 text-green-800 rounded-lg shadow-md">
                <h4 class="text-lg font-semibold">Hasil Perbandingan:</h4>
                <p class="mt-2 text-md">
                    {{ $percentage }}% karakter dari <span class="font-bold">"{{ $character1 }}"</span> muncul di <span class="font-bold">"{{ $character2 }}"</span>.
                </p>
            </div>
            @endisset
        </div>
    </div>
</x-app-layout>

