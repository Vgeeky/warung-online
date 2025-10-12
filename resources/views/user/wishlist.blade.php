@extends('user.layout')

@section('title', 'Wishlist')

@section('content')
<h1 class="text-3xl font-bold mb-8 text-center">Wishlist Kamu</h1>

@if(session('success'))
    <div class="bg-green-500/30 text-white p-3 rounded mb-4 text-center">
        {{ session('success') }}
    </div>
@endif

@if(empty($wishlist))
    <p class="text-center text-white text-lg">Kamu belum menambahkan produk ke wishlist</p>
@else
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($wishlist as $item)
            <div class="bg-white/10 backdrop-blur-md p-4 rounded-lg shadow text-white hover:scale-[1.02] transition">
                <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="w-full h-48 object-cover rounded-md mb-3">
                <h2 class="text-lg font-semibold">{{ $item['name'] }}</h2>
                <p class="text-indigo-200 mb-3">Rp {{ number_format($item['price'], 0, ',', '.') }}</p>

                <form action="{{ route('user.wishlist.remove', $item['id']) }}" method="POST">
                    @csrf
                    <button class="bg-red-500 px-4 py-1 rounded hover:bg-red-600 transition">Hapus</button>
                </form>
            </div>
        @endforeach
    </div>
@endif
@endsection
