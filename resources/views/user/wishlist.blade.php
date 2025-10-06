<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Wishlist') }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-6">
            <h3 class="text-lg font-semibold mb-4">Produk Favorit ❤️</h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-gray-100 p-4 rounded-lg shadow text-center">
                    <img src="https://via.placeholder.com/150" class="mx-auto rounded-md mb-3">
                    <h4 class="font-semibold">Sepatu Sneakers</h4>
                    <p class="text-gray-600">Rp 350.000</p>
                    <button class="mt-2 px-4 py-2 bg-green-600 text-white rounded-lg">Tambah ke Keranjang</button>
                </div>

                <div class="bg-gray-100 p-4 rounded-lg shadow text-center">
                    <img src="https://via.placeholder.com/150" class="mx-auto rounded-md mb-3">
                    <h4 class="font-semibold">Headset Gaming</h4>
                    <p class="text-gray-600">Rp 220.000</p>
                    <button class="mt-2 px-4 py-2 bg-green-600 text-white rounded-lg">Tambah ke Keranjang</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
