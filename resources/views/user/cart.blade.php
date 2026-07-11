@extends('user.layout')

@section('title', 'Keranjang')

@section('content')

<h1 class="text-3xl font-bold mb-8 text-center text-white">
    Keranjang Belanja
</h1>

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

    <p class="text-center text-white text-lg">
        Keranjang kamu kosong
    </p>

@else

<div class="overflow-x-auto bg-white/10 backdrop-blur-md rounded-lg p-4 shadow-lg">

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

            @php $grandTotal = 0; @endphp

            @foreach($cart as $item)

                @php

                    $price = $item['price'] ?? 0;

                    $qty = $item['quantity'] ?? 0;

                    $total = $price * $qty;

                    $grandTotal += $total;

                    $imagePath = $item['image'] ?? null;

                @endphp

                <tr class="border-b border-white/10 hover:bg-white/10 transition">

                    <td class="p-3">

                        <div class="flex items-center gap-4">

                            {{-- GAMBAR --}}
                            @if($imagePath)

                                <img src="{{ $imagePath }}"
                                    alt="{{ $item['name'] }}"
                                    class="w-16 h-16 rounded-lg object-cover border border-white/20">

                            @else

                                <div class="w-16 h-16 bg-gray-500 rounded-lg flex items-center justify-center">

                                    <span class="text-xs text-white/70">
                                        No Img
                                    </span>

                                </div>

                            @endif

                            {{-- NAMA --}}
                            <div>

                                <h3 class="font-semibold text-lg">
                                    {{ $item['name'] ?? 'Produk' }}
                                </h3>

                                <p class="text-sm text-white/70">
                                    Rp {{ number_format($price, 0, ',', '.') }}
                                </p>

                            </div>

                        </div>

                    </td>

                    {{-- QUANTITY --}}
                    <td class="text-center">

                        <div class="flex justify-center items-center gap-2">

                            {{-- MINUS --}}
                            <form action="{{ route('user.cart.update', $item['id']) }}"
                                  method="POST">

                                @csrf

                                <input type="hidden"
                                       name="quantity"
                                       value="{{ $qty - 1 }}">

                                <button type="submit"
                                        class="bg-gray-200 text-black w-8 h-8 rounded hover:bg-gray-300"
                                        {{ $qty <= 1 ? 'disabled' : '' }}>

                                    -

                                </button>

                            </form>

                            <span class="font-bold text-lg">
                                {{ $qty }}
                            </span>

                            {{-- PLUS --}}
                            <form action="{{ route('user.cart.update', $item['id']) }}"
                                  method="POST">

                                @csrf

                                <input type="hidden"
                                       name="quantity"
                                       value="{{ $qty + 1 }}">

                                <button type="submit"
                                        class="bg-yellow-400 text-black w-8 h-8 rounded hover:bg-yellow-500">

                                    +

                                </button>

                            </form>

                        </div>

                    </td>

                    {{-- HARGA --}}
                    <td class="text-center">
                        Rp {{ number_format($price, 0, ',', '.') }}
                    </td>

                    {{-- TOTAL --}}
                    <td class="text-center font-bold text-green-400">
                        Rp {{ number_format($total, 0, ',', '.') }}
                    </td>

                    {{-- HAPUS --}}
                    <td class="text-center">

                        <form action="{{ route('user.cart.remove', $item['id']) }}"
                              method="POST">

                            @csrf

                            <button type="submit"
                                    class="bg-red-500 px-4 py-2 rounded hover:bg-red-600 transition">

                                Hapus

                            </button>

                        </form>

                    </td>

                </tr>

            @endforeach

            {{-- TOTAL --}}
            <tr class="font-bold border-t border-white/30">

                <td colspan="3" class="text-right p-4 text-xl">
                    Total Keseluruhan:
                </td>

                <td class="text-center text-green-400 text-xl">
                    Rp {{ number_format($grandTotal, 0, ',', '.') }}
                </td>

                <td></td>

            </tr>

        </tbody>

    </table>

    {{-- CHECKOUT --}}
    <div class="flex justify-end mt-6">

        <a href="{{ route('checkout.page') }}"
           class="bg-yellow-400 hover:bg-yellow-500 text-black font-bold px-8 py-4 rounded-xl shadow-lg transition">

            Checkout Sekarang

        </a>

    </div>

</div>

@endif

@endsection