@extends('admin.layouts.app')

@section('title', 'Daftar Orders')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h3>📦 Daftar Orders</h3>
  <a href="{{ route('admin.orders.create') }}" class="btn btn-primary">+ Tambah Order</a>
</div>

@if (session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered align-middle bg-white">
  <thead class="table-dark">
    <tr>
      <th>ID</th>
      <th>User</th>
      <th>Total (Rp)</th>
      <th>Status</th>
      <th>Dibuat</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($orders as $order)
      <tr>
        <td>{{ $order->id }}</td>
        <td>{{ $order->user->name ?? 'Tidak ada' }}</td>
        <td>{{ number_format($order->total_amount, 0, ',', '.') }}</td>
        <td>{{ ucfirst($order->status) }}</td>
        <td>{{ $order->created_at->format('d M Y H:i') }}</td>
        <td>
          <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-sm btn-warning">Edit</a>
          <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" class="d-inline">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus order ini?')">Hapus</button>
          </form>
        </td>
      </tr>
    @empty
      <tr><td colspan="6" class="text-center">Belum ada data order</td></tr>
    @endforelse
  </tbody>
</table>
@endsection
