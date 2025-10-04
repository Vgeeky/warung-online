@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Add Order Item</h1>

    <form action="{{ route('admin.order_items.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Order</label>
            <select name="order_id" class="form-control" required>
                <option value="">-- Select Order --</option>
                @foreach ($orders as $order)
                    <option value="{{ $order->id }}">{{ $order->id }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Product</label>
            <select name="product_id" class="form-control" required>
                <option value="">-- Select Product --</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Quantity</label>
            <input type="number" name="quantity" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Price</label>
            <input type="number" name="price" class="form-control" step="0.01" required>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('admin.order_items.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
