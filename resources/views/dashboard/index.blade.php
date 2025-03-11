<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div x-data="{ openModal: false }" class="max-w-6xl mx-auto p-6 bg-white shadow-md rounded-lg my-5">
        <h2 class="text-3xl font-bold mb-6">Dashboard Keuangan</h2>

        @if (session('success'))
        <div class="bg-green-500 text-white p-3 rounded mb-4">
            {{ session('success') }}
        </div>
        @elseif (session('error'))
        <div class="bg-red-500 text-white-500 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="p-6 bg-blue-100 rounded-lg shadow-md text-center">
                <h3 class="text-xl font-semibold">Total Saldo</h3>
                <p class="text-4xl font-bold text-blue-600">Rp{{ number_format($totalBalance, 2, ',', '.') }}</p>
            </div>
            <div class="flex justify-center items-center">
                <button @click="openModal = true" class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg">
                    Tambah Transaksi
                </button>
            </div>
        </div>

        <div class="bg-white mt-6 p-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-semibold mb-4">Cash Flow (7 Hari Terakhir)</h3>
            <canvas id="cashFlowChart"></canvas>
        </div>

        <div class="bg-white mt-6 p-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-semibold mb-4">Transaksi Terbaru</h3>
            <table class="w-full border-collapse border border-gray-300 rounded-lg">
                <thead>
                <tr class="bg-gray-200 text-gray-700">
                    <th class="border p-2">Deskripsi</th>
                    <th class="border p-2">Jenis</th>
                    <th class="border p-2">Jumlah</th>
                    <th class="border p-2">Tanggal</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($transactions as $transaction)
                <tr class="text-center bg-white hover:bg-gray-100">
                    <td class="border p-2">{{ $transaction->description }}</td>
                    <td class="border p-2 {{ $transaction->transactionType == 'income' ? 'text-green-500' : 'text-red-500' }}">
                        {{ $transaction->transactionType == 'income' ? 'Masuk' : 'Keluar' }}
                    </td>
                    <td class="border p-2">Rp{{ number_format($transaction->amount, 2, ',', '.') }}</td>
                    <td class="border p-2">{{ $transaction->created_at->diffForHumans() }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div x-show="openModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                <h2 class="text-xl font-bold mb-4">Tambah Transaksi</h2>

                <form action="{{ route('transactions.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="block">Deskripsi</label>
                        <input type="text" name="description" class="w-full p-2 border rounded" required>
                    </div>
                    <div class="mb-3">
                        <label class="block">Jenis</label>
                        <select name="transactionType" class="w-full p-2 border rounded">
                            <option value="income">Uang Masuk</option>
                            <option value="expense">Uang Keluar</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="block">Jumlah</label>
                        <input type="number" name="amount" class="w-full p-2 border rounded" required>
                    </div>
                    <div class="flex justify-between mt-4">
                        <button type="button" @click="openModal = false" class="bg-gray-500 text-white px-4 py-2 rounded">
                            Batal
                        </button>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const ctx = document.getElementById('cashFlowChart').getContext('2d');
            const cashFlowChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($dates),
                    datasets: [
                        {
                            label: 'Pemasukan',
                            data: @json($incomeData),
                            backgroundColor: 'rgba(54, 162, 235, 0.6)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Pengeluaran',
                            data: @json($expenseData),
                            backgroundColor: 'rgba(255, 99, 132, 0.6)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>
