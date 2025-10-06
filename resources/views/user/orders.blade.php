<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pesanan Saya') }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-6">
            <h3 class="text-lg font-semibold mb-4">Daftar Pesanan 📦</h3>

            <table class="min-w-full border border-gray-200 rounded-xl">
                <thead class="bg-green-600 text-white">
                    <tr>
                        <th class="px-4 py-2">#</th>
                        <th class="px-4 py-2">Produk</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Total</th>
                        <th class="px-4 py-2">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    <tr>
                        <td class="border px-4 py-2">1</td>
                        <td class="border px-4 py-2">Kopi Arabica</td>
                        <td class="border px-4 py-2 text-green-600">Selesai</td>
                        <td class="border px-4 py-2">Rp 50.000</td>
                        <td class="border px-4 py-2">01-10-2025</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">2</td>
                        <td class="border px-4 py-2">T-Shirt Warung Online</td>
                        <td class="border px-4 py-2 text-yellow-600">Proses</td>
                        <td class="border px-4 py-2">Rp 120.000</td>
                        <td class="border px-4 py-2">02-10-2025</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
