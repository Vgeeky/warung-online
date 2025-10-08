@extends('admin.layouts.app')

@section('title', 'Detail Order')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Detail Order</h4>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-light btn-sm">← Kembali</a>
        </div>

        <div class="card-body">
            <div class="mb-3">
                <strong>Nama Pelanggan:</strong> {{ $order->customer_name }}
            </div>
            <div class="mb-3">
                <strong>Produk:</strong> {{ $order->product }}
            </div>
            <div class="mb-3">
                <strong>Jumlah:</strong> {{ $order->quantity }}
            </div>
            <div class="mb-3">
                <strong>Total Harga:</strong> Rp {{ number_format($order->total_price, 0, ',', '.') }}
            </div>
            <div class="mb-3">
                <strong>Status:</strong>
                <span class="badge
                    @if($order->status == 'paid') bg-success
                    @elseif($order->status == 'pending') bg-warning
                    @else bg-danger @endif">
                    {{ ucfirst($order->status) }}
                </span>
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-warning me-2">Edit</a>
                <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus order ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
