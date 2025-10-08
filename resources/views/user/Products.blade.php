@extends('user.layout')

@section('content')
<h2>Daftar Produk</h2>
<div class="row">
    @foreach($products as $product)
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm">
            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
            <div class="card-body">
                <h5>{{ $product->name }}</h5>
                <p class="text-muted">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                <button class="btn btn-sm btn-primary">Tambah ke Keranjang</button>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
