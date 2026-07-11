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

        /* NAVBAR */
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

        /* FOOTER */
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

    <!-- NAVBAR -->
    <nav class="px-8 py-4 flex items-center justify-between">

        <!-- LOGO -->
        <div class="flex-1">

            <a href="{{ route('dashboard') }}"
               class="text-3xl font-bold tracking-wide">

                Warung Online

            </a>

        </div>

        <!-- MENU -->
        <div class="flex-1 flex justify-center space-x-12 text-sm">

            <a href="{{ route('dashboard') }}">
                Dashboard
            </a>

            <a href="{{ route('user.cart') }}">
                Keranjang
            </a>

            <a href="{{ auth()->check() ? route('user.history') : '#' }}"

               @guest
                   onclick="alert('Kamu harus login dulu!')"
               @endguest>

                History

            </a>

        </div>

        <!-- LOGIN / LOGOUT -->
        <div class="flex-1 flex justify-end">

            @auth

                {{-- JIKA LOGIN --}}
                <form method="POST"
                      action="{{ route('logout') }}">

                    @csrf

                    <button
                        type="submit"
                        class="bg-red-500 hover:bg-red-600 px-5 py-2 rounded-lg text-white font-semibold transition">

                        Logout

                    </button>

                </form>

            @else

                {{-- JIKA BELUM LOGIN --}}
                <a href="{{ route('login') }}"
                   class="bg-yellow-400 hover:bg-yellow-500 px-5 py-2 rounded-lg text-black font-semibold transition">

                    Login

                </a>

            @endauth

        </div>

    </nav>

    <!-- CSRF -->
    <meta name="csrf-token"
          content="{{ csrf_token() }}">

    <!-- CONTENT -->
    <main class="flex-1 max-w-7xl mx-auto w-full py-10 px-4">

        @yield('content')

    </main>

    <!-- FOOTER -->
    <footer>

        © {{ date('Y') }} Warung Online. Semua hak dilindungi.

    </footer>

</body>
</html>