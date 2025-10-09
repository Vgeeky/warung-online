@extends('user.layout')

@section('title', 'Pesanan')

@section('content')
<h1 class="text-3xl font-bold mb-8 text-center">📦 Riwayat Pesanan</h1>

@if(empty($orders))
    <p class="text-center text-white text-lg">Belum ada pesanan 😇</p>
@else
    @foreach($orders as $order)
        <div class="bg-white/10 backdrop-blur-md p-5 rounded-lg shadow mb-6 text-white">
            <div class="flex justify-between">
                <p><strong>ID Pesanan:</strong> {{ $order['id'] }}</p>
                <p><strong>Tanggal:</strong> {{ $order['date'] }}</p>
            </div>
            <ul class="mt-3 space-y-1">
                @foreach($order['items'] as $item)
                    <li>- {{ $item['name'] }} ({{ $item['quantity'] }}x) - Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</li>
                @endforeach
            </ul>
            <p class="mt-2 font-semibold text-right text-lg">Total: Rp {{ number_format($order['total'], 0, ',', '.') }}</p>
        </div>
    @endforeach
@endif
@endsection
