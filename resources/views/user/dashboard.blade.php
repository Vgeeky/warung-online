@extends('user.layout')

@section('title', 'Dashboard')

@section('content')
    <style>
        /* 🌈 Font & Background */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap');

        body {
            font-family: 'Poppins', 'Inter', sans-serif;
            background: linear-gradient(135deg, #007bff, #6610f2);
            min-height: 100vh;
            color: #f0f3ff;
            margin: 0;
            padding: 0;
        }

        /* ✨ Container utama */
        .dashboard-container {
            max-width: 1200px;
            margin: 3rem auto;
            padding: 2rem;
        }

        /* 💬 Judul */
        h1 {
            text-align: center;
            font-weight: 700;
            margin-bottom: 2rem;
            letter-spacing: 0.5px;
            color: #ffffff;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
            font-family: 'Poppins', sans-serif;
        }

        /* 🌟 Kartu produk (Glassmorphism) */
        .product-card {
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: 1rem;
            padding: 1.5rem;
            color: #f9f9ff;
            transition: all 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }

        /* 🏷️ Nama produk & harga */
        .product-card h2 {
            font-size: 1.25rem;
            font-weight: 600;
            color: #ffffff;
            margin-bottom: 0.5rem;
        }

        .product-card p {
            color: #dce6ff;
            font-weight: 500;
            font-family: 'Inter', sans-serif;
        }

        /* 📸 Gambar produk */
        img {
            border-radius: 0.75rem;
            border: 2px solid rgba(255, 255, 255, 0.3);
            width: 100%;
            height: 200px;
            object-fit: cover;
            margin-bottom: 1rem;
        }

        /* 🧮 Input jumlah */
        input[type="number"] {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            text-align: center;
            font-weight: 600;
            border-radius: 0.5rem;
            padding: 0.4rem;
            width: 70px;
            transition: background 0.3s ease;
        }

        input[type="number"]:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.35);
        }

        /* 🛒 Tombol */
        .btn-primary {
            background: linear-gradient(90deg, #ff9100, #ffb84d);
            color: white;
            border: none;
            padding: 0.5rem 1.25rem;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-primary:hover {
            transform: scale(1.05);
            filter: brightness(1.1);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.25);
            color: #ffffff;
            border: none;
            padding: 0.5rem 1.25rem;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: 0.3s;
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.35);
        }

        /* 🧾 Alert sukses */
        .alert-success {
            background: rgba(56, 142, 60, 0.3);
            border: 1px solid rgba(56, 142, 60, 0.5);
            color: #e8ffe8;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            text-align: center;
            font-weight: 500;
        }

        /* 🧩 Grid produk */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }
    </style>

    <div class="dashboard-container">
        <h1>Produk Tersedia</h1>

        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid">
            @forelse($products as $product)
                <div class="product-card">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                    <h2>{{ $product->name }}</h2>
                    <p class="mb-3">Rp {{ number_format($product->price, 0, ',', '.') }}</p>

                    <form action="{{ route('user.cart.add', $product->id) }}" method="POST" class="space-y-2">
                        @csrf
                        <div class="flex items-center justify-between">
                            <input type="number" name="quantity" value="1" min="1">
                            <button class="btn-primary">Tambah</button>
                        </div>
                    </form>

                    <form action="{{ route('user.wishlist.add', $product->id) }}" method="POST" class="mt-2">
                        @csrf
                        <button class="btn-secondary w-full">Tambah ke Wishlist</button>
                    </form>
                </div>
            @empty
                <p class="text-center text-white">Tidak ada produk tersedia.</p>
            @endforelse
        </div>
    </div>
@endsection
