@extends('user.layout')

@section('title', 'Keranjang')

@section('content')
<h1 class="text-3xl font-bold mb-8 text-center">Keranjang Belanja</h1>

@if(session('success'))
    <div class="bg-green-500/30 text-white p-3 rounded mb-4 text-center">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="bg-red-500/30 text-white p-3 rounded mb-4 text-center">
        {{ session('error') }}
    </div>
@endif

@if(empty($cart))
    <p class="text-center text-white text-lg">Keranjang kamu kosong</p>
@else
    <div class="overflow-x-auto bg-white/10 backdrop-blur-md rounded-lg p-4">
        <table class="w-full text-white">
            <thead>
                <tr class="text-left border-b border-white/30">
                    <th class="p-3">Produk</th>
                    <th class="p-3 text-center">Jumlah</th>
                    <th class="p-3 text-center">Harga</th>
                    <th class="p-3 text-center">Total</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $item)
                    <tr class="border-b border-white/10 hover:bg-white/10">
                        <td class="p-3 flex items-center space-x-3">
                            @php
                                $imagePath = isset($item['image']) 
                                    ? $item['image'] 
                                    : ($item['image_url'] ?? null);
                            @endphp

                            @if($imagePath)
                                <img src="{{ asset('storage/' . $imagePath) }}" 
                                     class="w-12 h-12 rounded object-cover">
                            @else
                                <div class="w-12 h-12 bg-gray-500 rounded flex items-center justify-center">
                                    <span class="text-sm text-white/70">No Img</span>
                                </div>
                            @endif

                            <span>{{ $item['name'] ?? 'Produk Tanpa Nama' }}</span>
                        </td>

                        <td class="text-center">{{ $item['quantity'] ?? 0 }}</td>
                        <td class="text-center">
                            Rp {{ number_format($item['price'] ?? 0, 0, ',', '.') }}
                        </td>
                        <td class="text-center font-semibold">
                            Rp {{ number_format(($item['price'] ?? 0) * ($item['quantity'] ?? 0), 0, ',', '.') }}
                        </td>
                        <td class="text-center">
                            <form action="{{ route('user.cart.remove', $item['id'] ?? 0) }}" method="POST">
                                @csrf
                                <button class="bg-red-500 px-3 py-1 rounded hover:bg-red-600 transition">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <form action="{{ route('user.cart.checkout') }}" method="POST" class="mt-6 text-right">
        @csrf
        <button class="bg-green-500 text-white px-5 py-2 rounded-lg hover:bg-green-600 transition">
            💳 Checkout Sekarang
        </button>
    </form>
@endif
@endsection
