<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Warung Online</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #007bff, #6610f2);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #333;
        }
        .login-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            padding: 40px;
            width: 100%;
            max-width: 400px;
        }
        .login-card h3 {
            font-weight: bold;
            margin-bottom: 20px;
            color: #007bff;
        }
        .btn-custom {
            background-color: #ffc107;
            color: #000;
            font-weight: 600;
        }
        .btn-custom:hover {
            background-color: #e0a800;
        }
        a {
            text-decoration: none;
        }
    </style>
</head>
<body>

    <div class="login-card text-center">
        <h3>Login ke Warung Online</h3>
        <p class="text-muted">Silakan masuk untuk melanjutkan</p>

        <!-- Status session (misal: "Password berhasil direset") -->
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-3 text-start">
                <label for="email" class="form-label">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}"
                       class="form-control @error('email') is-invalid @enderror" required autofocus>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3 text-start">
                <label for="password" class="form-label">Password</label>
                <input id="password" type="password" name="password"
                       class="form-control @error('password') is-invalid @enderror" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Remember me -->
            <div class="form-check mb-3 text-start">
                <input type="checkbox" name="remember" id="remember_me" class="form-check-input">
                <label class="form-check-label" for="remember_me">Ingat saya</label>
            </div>

            <!-- Tombol Login -->
            <button type="submit" class="btn btn-custom w-100 mb-3">Masuk</button>

            <!-- Link tambahan -->
            <div class="d-flex justify-content-between">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-primary small">Lupa Password?</a>
                @endif
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="text-primary small">Daftar Akun</a>
                @endif
            </div>
        </form>

        <hr class="my-4">

        <a href="{{ url('/') }}" class="text-secondary small">
            ← Kembali ke Halaman Utama
        </a>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
