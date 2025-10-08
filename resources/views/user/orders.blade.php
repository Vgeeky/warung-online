@extends('user.layout')

@section('title', 'Pesanan')

@section('content')
<h1 class="text-2xl font-bold mb-6">📦 Riwayat Pesanan</h1>

@if(session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
@endif

@if(empty($orders))
    <p>Belum ada pesanan.</p>
@else
    @foreach($orders as $order)
        <div class="bg-white p-4 rounded shadow mb-4">
            <div class="flex justify-between">
                <p><strong>ID Pesanan:</strong> {{ $order['id'] }}</p>
                <p><strong>Tanggal:</strong> {{ $order['date'] }}</p>
            </div>
            <ul class="mt-3">
                @foreach($order['items'] as $item)
                    <li>- {{ $item['name'] }} ({{ $item['quantity'] }}x) - Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</li>
                @endforeach
            </ul>
            <p class="mt-2 font-semibold text-right">Total: Rp {{ number_format($order['total'], 0, ',', '.') }}</p>
        </div>
    @endforeach
@endif
@endsection
