@extends('user.layout')

@section('title', 'Keranjang')

@section('content')
<h1 class="text-2xl font-bold mb-6">🛒 Keranjang Belanja</h1>

@if(session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">{{ session('error') }}</div>
@endif

@if(empty($cart))
    <p>Keranjang kosong.</p>
@else
    <table class="w-full bg-white rounded shadow">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-3 text-left">Produk</th>
                <th class="p-3">Jumlah</th>
                <th class="p-3">Harga</th>
                <th class="p-3">Total</th>
                <th class="p-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cart as $item)
                <tr class="border-b">
                    <td class="p-3 flex items-center space-x-3">
                        <img src="{{ asset('storage/' . $item['image']) }}" class="w-12 h-12 rounded">
                        <span>{{ $item['name'] }}</span>
                    </td>
                    <td class="text-center">{{ $item['quantity'] }}</td>
                    <td class="text-center">Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                    <td class="text-center font-semibold">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</td>
                    <td class="text-center">
                        <form action="{{ route('user.cart.remove', $item['id']) }}" method="POST">
                            @csrf
                            <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <form action="{{ route('user.cart.checkout') }}" method="POST" class="mt-6 text-right">
        @csrf
        <button class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
            Checkout Sekarang
        </button>
    </form>
@endif
@endsection
