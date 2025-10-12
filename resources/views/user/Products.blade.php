@extends('user.layout')

@section('title', 'Daftar Produk')

@section('content')
<h1 class="text-3xl font-bold mb-8 text-center">Produk Kami</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    @foreach($products as $product)
        <div class="bg-white/10 backdrop-blur-md p-5 rounded-lg shadow text-white hover:scale-[1.02] transition">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-md mb-4">
            <h2 class="text-lg font-semibold">{{ $product->name }}</h2>
            <p class="text-indigo-200 mb-3">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            <button class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition">
                Tambah ke Keranjang
            </button>
        </div>
    @endforeach
</div>
@endsection
