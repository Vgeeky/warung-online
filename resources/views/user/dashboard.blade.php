@extends('user.layout')

@section('title', 'Dashboard')

@section('content')
<h1 class="text-2xl font-bold mb-6">🛍️ Produk Tersedia</h1>

@if(session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    @forelse($products as $product)
        <div class="bg-white shadow-md rounded-lg p-4">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-md mb-3">
            <h2 class="text-lg font-semibold">{{ $product->name }}</h2>
            <p class="text-gray-500 mb-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>

            <form action="{{ route('user.cart.add', $product->id) }}" method="POST" class="space-y-2">
                @csrf
                <input type="number" name="quantity" value="1" min="1" class="w-16 border rounded px-2 py-1">
                <div class="flex space-x-2">
                    <button class="bg-orange-500 text-white px-3 py-1 rounded hover:bg-orange-600">🛒 Tambah</button>
                    <form action="{{ route('user.wishlist.add', $product->id) }}" method="POST">
                        @csrf
                        <button class="bg-gray-200 text-gray-700 px-3 py-1 rounded hover:bg-gray-300">❤️ Wishlist</button>
                    </form>
                </div>
            </form>
        </div>
    @empty
        <p>Tidak ada produk tersedia.</p>
    @endforelse
</div>
@endsection
