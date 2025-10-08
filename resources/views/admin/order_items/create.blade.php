@extends('admin.layouts.app')

@section('title', 'Tambah Item Order')

@section('content')
<div class="card shadow-sm">
  <div class="card-header bg-primary text-white">Tambah Item Order</div>
  <div class="card-body">
    <form action="{{ route('admin.order_items.store') }}" method="POST">
      @csrf

      <div class="mb-3">
        <label class="form-label">Order</label>
        <select name="order_id" id="order_id" class="form-select" required>
          <option value="">-- Pilih Order --</option>
          @foreach ($orders as $order)
            <option value="{{ $order->id }}">
              #{{ $order->id }} - {{ $order->user->name ?? 'Tanpa user' }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Produk</label>
        <select name="product_id" id="product_id" class="form-select" required>
          <option value="">-- Pilih Produk --</option>
          @foreach ($products as $product)
            <option value="{{ $product->id }}" data-price="{{ $product->price }}">
              {{ $product->name }} (Rp {{ number_format($product->price, 0, ',', '.') }})
            </option>
          @endforeach
        </select>
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">Jumlah</label>
          <input type="number" name="quantity" id="quantity" value="1" class="form-control" min="1">
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label">Harga per Produk</label>
          <input type="number" name="price" id="price" class="form-control" readonly>
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label">Total (Rp)</label>
        <input type="text" id="total_display" class="form-control" readonly>
      </div>

      <button type="submit" class="btn btn-success">Simpan</button>
      <a href="{{ route('admin.order_items.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const productSelect = document.getElementById('product_id');
  const priceInput = document.getElementById('price');
  const qtyInput = document.getElementById('quantity');
  const totalDisplay = document.getElementById('total_display');

  function updatePrice() {
    const selected = productSelect.options[productSelect.selectedIndex];
    const price = parseFloat(selected.getAttribute('data-price')) || 0;
    priceInput.value = price;
    updateTotal();
  }

  function updateTotal() {
    const price = parseFloat(priceInput.value) || 0;
    const qty = parseInt(qtyInput.value) || 1;
    totalDisplay.value = (price * qty).toLocaleString('id-ID');
  }

  productSelect.addEventListener('change', updatePrice);
  qtyInput.addEventListener('input', updateTotal);
});
</script>
@endsection
