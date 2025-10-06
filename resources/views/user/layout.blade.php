<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-lg h-screen p-5">
        <h2 class="text-2xl font-bold text-green-600 mb-6">Warung Online</h2>
        <nav>
            <ul class="space-y-4">
                <li><a href="{{ route('user.dashboard') }}" class="block px-4 py-2 rounded hover:bg-green-100">🏠 Dashboard</a></li>
                <li><a href="{{ route('user.orders') }}" class="block px-4 py-2 rounded hover:bg-green-100">📦 Pesanan Saya</a></li>
                <li><a href="{{ route('user.cart') }}" class="block px-4 py-2 rounded hover:bg-green-100">🛒 Keranjang</a></li>
                <li><a href="{{ route('user.wishlist') }}" class="block px-4 py-2 rounded hover:bg-green-100">❤️ Wishlist</a></li>
                <li><a href="{{ route('user.profile') }}" class="block px-4 py-2 rounded hover:bg-green-100">👤 Profil</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 rounded hover:bg-red-100">🚪 Logout</button>
                    </form>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8">
        @yield('content')
    </main>
</body>
</html>
