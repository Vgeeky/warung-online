<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warung Online - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(135deg, #007bff, #6610f2);
            color: #f3f4f6;
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        nav {
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.25);
        }

        nav a {
            color: #f9fafb;
            font-weight: 500;
            transition: all 0.25s ease;
        }

        nav a:hover {
            color: #ffe082;
            text-shadow: 0 0 6px rgba(255, 224, 130, 0.6);
        }

        footer {
            background: rgba(255, 255, 255, 0.12);
            color: #e0e7ff;
            text-align: center;
            padding: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.25);
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="px-8 py-4 flex items-center justify-between">
        <div class="flex items-center flex-1">
            <!-- Logo kiri -->
            <a href="{{ route('user.dashboard') }}" class="text-xl font-bold tracking-wide">
                🍊 Warung Online
            </a>
        </div>

        <!-- Menu tengah -->
        <div class="flex-1 flex justify-center space-x-12 text-sm">
            <a href="{{ route('user.dashboard') }}">🏠 Dashboard</a>
            <a href="{{ route('user.orders') }}">📦 Pesanan</a>
            <a href="{{ route('user.wishlist') }}">💖 Wishlist</a>
            <a href="{{ route('user.cart') }}">🛒 Keranjang</a>
        </div>

        <!-- Profil kanan -->
        <div class="flex-1 flex justify-end">
            <a href="{{ route('profile.edit') }}" 
               class="text-sm font-semibold hover:text-yellow-300 flex items-center space-x-1">
                <span>👤</span>
                <span>Profil</span>
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-1 max-w-7xl mx-auto w-full py-10 px-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        © {{ date('Y') }} Warung Online. Semua hak dilindungi.
    </footer>

</body>
</html>
