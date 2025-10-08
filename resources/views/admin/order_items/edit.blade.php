@extends('admin.layouts.app')

@section('title', 'Edit Item Order')

@section('content')
<div class="card shadow-sm">
  <div class="card-header bg-warning text-white">Edit Item Order</div>
  <div class="card-body">
    <form action="{{ route('admin.order_items.update', $order_item->id) }}" method="POST">
      @csrf @method('PUT')

      <div class="mb-3">
        <label class="form-label">Order</label>
        <select name="order_id" class="form-select">
          @foreach ($orders as $order)
            <option value="{{ $order->id }}" {{ $order->id == $order_item->order_id ? 'selected' : '' }}>
              #{{ $order->id }} - {{ $order->user->name ?? 'Tanpa user' }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Produk</label>
        <select name="product_id" class="form-select">
          @foreach ($products as $product)
            <option value="{{ $product->id }}" {{ $product->id == $order_item->product_id ? 'selected' : '' }}>
              {{ $product->name }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">Jumlah</label>
          <input type="number" name="quantity" value="{{ $order_item->quantity }}" class="form-control" min="1">
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label">Harga per Produk</label>
          <input type="number" name="price" value="{{ $order_item->price }}" class="form-control">
        </div>
      </div>

      <button type="submit" class="btn btn-success">Update</button>
      <a href="{{ route('admin.order_items.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</div>
@endsection
