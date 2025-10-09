<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warung Online</title>

    <!-- Tambahkan Bootstrap biar cepat -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f8f9fa;
        }
        .hero {
            background: linear-gradient(135deg, #007bff, #6610f2);
            color: white;
            padding: 100px 0;
        }
        .btn-custom {
            background-color: #ffc107;
            color: #000;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">WarungOnline</a>
            <div>
                <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Login</a>
                <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
            </div>
        </div>
    </nav>

    <section class="hero text-center">
        <div class="container">
            <h1 class="fw-bold">Selamat Datang di Warung Online</h1>
            <p class="lead">Tempat belanja kebutuhan sehari-hari dengan mudah dan cepat</p>
            <a href="{{ route('login') }}" class="btn btn-custom btn-lg mt-3">Mulai Sekarang</a>
        </div>
    </section>

    <section class="container text-center mt-5">
        <h2 class="mb-4">Kenapa pilih kami?</h2>
        <div class="row">
            <div class="col-md-4">
                <h5>🛒 Produk Lengkap</h5>
                <p>Tersedia berbagai kebutuhan rumah tangga, minuman, dan snack.</p>
            </div>
            <div class="col-md-4">
                <h5>🚚 Pengiriman Cepat</h5>
                <p>Pesanan diantar langsung ke rumah Anda dengan cepat dan aman.</p>
            </div>
            <div class="col-md-4">
                <h5>💳 Pembayaran Mudah</h5>
                <p>Bayar dengan metode yang Anda sukai, dari transfer hingga e-wallet.</p>
            </div>
        </div>
    </section>

    <footer class="text-center mt-5 py-4 bg-light">
        <small>&copy; {{ date('Y') }} Warung Online. All rights reserved.</small>
    </footer>
</body>
</html>
