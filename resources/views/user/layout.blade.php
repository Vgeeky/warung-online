<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warung Online - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-orange-500 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
            <a href="{{ route('user.dashboard') }}" class="text-xl font-bold">🍊 Warung Online</a>
            <div class="space-x-6">
                <a href="{{ route('user.dashboard') }}" class="hover:underline">Dashboard</a>
                <a href="{{ route('user.orders') }}" class="hover:underline">Pesanan</a>
                <a href="{{ route('user.wishlist') }}" class="hover:underline">Wishlist</a>
                <a href="{{ route('user.cart') }}" class="hover:underline">Keranjang</a>
                <a href="{{ route('profile.edit') }}" class="hover:underline">Profil</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-1 max-w-7xl mx-auto w-full py-8 px-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t mt-10 py-4 text-center text-gray-500 text-sm">
        © {{ date('Y') }} Warung Online. Semua hak dilindungi.
    </footer>

</body>
</html>
