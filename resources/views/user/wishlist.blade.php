@extends('user.layout')

@section('title', 'Wishlist')

@section('content')
<h1 class="text-2xl font-bold mb-6">💖 Wishlist Kamu</h1>

@if(session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@if(empty($wishlist))
    <p>Kamu belum menambahkan produk ke wishlist.</p>
@else
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($wishlist as $item)
            <div class="bg-white shadow-md rounded-lg p-4">
                <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="w-full h-48 object-cover rounded-md mb-3">
                <h2 class="text-lg font-semibold">{{ $item['name'] }}</h2>
                <p class="text-gray-500 mb-2">Rp {{ number_format($item['price'], 0, ',', '.') }}</p>

                <form action="{{ route('user.wishlist.remove', $item['id']) }}" method="POST">
                    @csrf
                    <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Hapus</button>
                </form>
            </div>
        @endforeach
    </div>
@endif
@endsection
