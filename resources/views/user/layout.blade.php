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

        /* ✨ Dropdown Styles */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            margin-top: 0.5rem;
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: 0.5rem;
            min-width: 160px;
            z-index: 50;
        }

        .dropdown-menu a,
        .dropdown-menu button {
            display: block;
            width: 100%;
            text-align: left;
            padding: 0.75rem 1rem;
            color: white;
            background: transparent;
            border: none;
            cursor: pointer;
            font-weight: 500;
            transition: 0.3s;
        }

        .dropdown-menu a:hover,
        .dropdown-menu button:hover {
            background: rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="px-8 py-4 flex items-center justify-between">
        <!-- Logo kiri -->
        <div class="flex-1">
            <a href="{{ route('user.dashboard') }}" class="text-xl font-bold tracking-wide">
                Warung Online
            </a>
        </div>

        <!-- Menu tengah -->
        <div class="flex-1 flex justify-center space-x-12 text-sm">
            <a href="{{ route('user.dashboard') }}">Dashboard</a>
            <a href="{{ route('user.orders') }}">Pesanan</a>
            <a href="{{ route('user.wishlist') }}">Wishlist</a>
            <a href="{{ route('user.cart') }}">Keranjang</a>
        </div>

        <!-- Profil kanan (Dropdown) -->
        <div class="flex-1 flex justify-end">
            <div class="dropdown">
                <button id="profileButton" class="flex items-center space-x-2 bg-white/10 px-3 py-2 rounded-lg hover:bg-white/20 transition">
                    <span>{{ auth()->user()->name ?? 'Profil' }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div id="profileMenu" class="dropdown-menu">
                    <a href="{{ route('profile.edit') }}">Edit Profil</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </div>
            </div>
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

    <!-- Script Dropdown -->
    <script>
        const profileButton = document.getElementById('profileButton');
        const profileMenu = document.getElementById('profileMenu');

        profileButton.addEventListener('click', (e) => {
            e.stopPropagation();
            profileMenu.style.display = profileMenu.style.display === 'block' ? 'none' : 'block';
        });

        document.addEventListener('click', (e) => {
            if (!profileButton.contains(e.target)) {
                profileMenu.style.display = 'none';
            }
        });
    </script>

</body>
</html>
