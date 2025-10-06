@extends('layouts.user')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h1 class="text-2xl font-bold text-gray-800">
        👋 Selamat datang, {{ Auth::user()->name }}
    </h1>
    <p class="mt-2 text-gray-600">Senang melihatmu kembali!</p>

    <!-- Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
        <div class="p-6 bg-orange-100 rounded-lg shadow hover:shadow-lg transition">
            <h2 class="text-lg font-semibold text-orange-700">Pesanan Saya</h2>
            <p class="text-gray-600">Cek status belanja terbaru.</p>
        </div>
        <div class="p-6 bg-orange-50 rounded-lg shadow hover:shadow-lg transition">
            <h2 class="text-lg font-semibold text-orange-700">Wishlist</h2>
            <p class="text-gray-600">Simpan produk favoritmu.</p>
        </div>
        <div class="p-6 bg-orange-200 rounded-lg shadow hover:shadow-lg transition">
            <h2 class="text-lg font-semibold text-orange-700">Keranjang</h2>
            <p class="text-gray-600">Lanjutkan belanja sekarang.</p>
        </div>
    </div>
</div>
@endsection
