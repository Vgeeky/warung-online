@extends('admin.layouts.app')

@section('title', 'Daftar Item Order')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h3>📦 Daftar Item Order</h3>
  <a href="{{ route('admin.order_items.create') }}" class="btn btn-primary">+ Tambah Item</a>
</div>

@if (session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered align-middle bg-white">
  <thead class="table-dark">
    <tr>
      <th>ID</th>
      <th>Order</th>
      <th>Produk</th>
      <th>Qty</th>
      <th>Harga (Rp)</th>
      <th>Subtotal (Rp)</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($items as $item)
      <tr>
        <td>{{ $item->id }}</td>
        <td>#{{ $item->order_id }} - {{ $item->order->user->name ?? 'Tanpa User' }}</td>
        <td>{{ $item->product->name ?? 'Produk hilang' }}</td>
        <td>{{ $item->quantity }}</td>
        <td>{{ number_format($item->price, 0, ',', '.') }}</td>
        <td>{{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
        <td>
          <a href="{{ route('admin.order_items.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
          <form action="{{ route('admin.order_items.destroy', $item->id) }}" method="POST" class="d-inline">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus item ini?')">Hapus</button>
          </form>
        </td>
      </tr>
    @empty
      <tr><td colspan="7" class="text-center">Belum ada data item order</td></tr>
    @endforelse
  </tbody>
</table>
@endsection
