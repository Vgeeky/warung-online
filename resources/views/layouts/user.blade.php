<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .sidebar-link {
            display: block;
            padding: 12px 16px;
            margin: 4px 0;
            border-radius: 8px;
            font-weight: 500;
            color: #444;
            transition: all 0.3s;
        }
        .sidebar-link:hover {
            background-color: #ffedd5; /* orange muda */
            color: #f97316; /* orange */
        }
        .sidebar-link.active {
            background-color: #f97316; /* orange */
            color: white;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="min-h-screen flex">

        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md">
            <div class="p-4 text-xl font-bold text-orange-600 border-b">
                Warung Online
            </div>
            <nav class="p-4">
                <a href="{{ route('user.dashboard') }}" 
                   class="sidebar-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                   📊 Dashboard
                </a>
                <a href="{{ route('user.orders') }}" 
                   class="sidebar-link {{ request()->routeIs('user.orders') ? 'active' : '' }}">
                   🛒 Pesanan Saya
                </a>
                <a href="{{ route('user.wishlist') }}" 
                   class="sidebar-link {{ request()->routeIs('user.wishlist') ? 'active' : '' }}">
                   ❤️ Wishlist
                </a>
                <a href="{{ route('user.cart') }}" 
                   class="sidebar-link {{ request()->routeIs('user.cart') ? 'active' : '' }}">
                   🛍️ Keranjang
                </a>
                <a href="{{ route('profile.edit') }}" 
                   class="sidebar-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                   ⚙️ Profil
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>
</body>
</html>
