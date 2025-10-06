<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Keranjang Belanja') }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-6">
            <h3 class="text-lg font-semibold mb-4">Produk di Keranjang 🛒</h3>

            <table class="min-w-full border border-gray-200 rounded-xl">
                <thead class="bg-green-600 text-white">
                    <tr>
                        <th class="px-4 py-2">Produk</th>
                        <th class="px-4 py-2">Harga</th>
                        <th class="px-4 py-2">Jumlah</th>
                        <th class="px-4 py-2">Subtotal</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    <tr>
                        <td class="border px-4 py-2">Kopi Arabica</td>
                        <td class="border px-4 py-2">Rp 50.000</td>
                        <td class="border px-4 py-2">
                            <input type="number" value="2" class="w-16 border rounded text-center">
                        </td>
                        <td class="border px-4 py-2">Rp 100.000</td>
                        <td class="border px-4 py-2">
                            <button class="px-3 py-1 bg-red-600 text-white rounded-lg">Hapus</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">T-Shirt Warung Online</td>
                        <td class="border px-4 py-2">Rp 120.000</td>
                        <td class="border px-4 py-2">
                            <input type="number" value="1" class="w-16 border rounded text-center">
                        </td>
                        <td class="border px-4 py-2">Rp 120.000</td>
                        <td class="border px-4 py-2">
                            <button class="px-3 py-1 bg-red-600 text-white rounded-lg">Hapus</button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Total -->
            <div class="flex justify-between items-center mt-6">
                <p class="text-lg font-bold">Total: Rp 220.000</p>
                <button class="px-6 py-2 bg-green-600 text-white rounded-lg">Checkout</button>
            </div>
        </div>
    </div>
</x-app-layout>
