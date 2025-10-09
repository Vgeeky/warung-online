<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Warung Online</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #007bff, #6610f2);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .register-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            padding: 40px;
            width: 100%;
            max-width: 450px;
        }
        .register-card h3 {
            font-weight: bold;
            margin-bottom: 15px;
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

    <div class="register-card text-center">
        <h3>Buat Akun Baru</h3>
        <p class="text-muted">Daftar untuk bergabung dengan Warung Online</p>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Nama -->
            <div class="mb-3 text-start">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}"
                       class="form-control @error('name') is-invalid @enderror" required autofocus>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-3 text-start">
                <label for="email" class="form-label">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}"
                       class="form-control @error('email') is-invalid @enderror" required>
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

            <!-- Konfirmasi Password -->
            <div class="mb-3 text-start">
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation"
                       class="form-control @error('password_confirmation') is-invalid @enderror" required>
                @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Role -->
            <div class="mb-3 text-start">
                <label for="role" class="form-label">Pilih Role</label>
                <select id="role" name="role" class="form-select" required>
                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <!-- Tombol Register -->
            <button type="submit" class="btn btn-custom w-100 mb-3">Daftar</button>

            <!-- Link tambahan -->
            <div class="text-center">
                <p class="mb-0 small">Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-primary">Masuk di sini</a>
                </p>
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
