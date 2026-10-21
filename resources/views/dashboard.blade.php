<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kasir - Toko Semen Jaya</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-custom {
            background-color: #0d9488; /* Warna hijau teal sesuai gambar */
        }
    </style>
</head>
<body class="bg-light">

    <!-- Header Navbar -->
    <nav class="navbar navbar-custom py-3 text-white">
        <div class="container-fluid px-4 d-flex justify-content-between align-items-center">
            <h3 class="fw-bold m-0 fs-4">Toko Semen Jaya - Kasir</h3>
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn btn-danger px-3 py-1">Logout</button>
            </form>
        </div>
    </nav>

    <!-- Content Dashboard -->
    <div class="container py-4">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body p-4">
                <h1 class="fw-bold mb-3">Dashboard Kasir</h1>
                
                <p class="fs-5 mb-1">Selamat datang, <strong>{{ Auth::user()->name ?? 'Kasir' }}</strong></p>
                <p class="fs-5 mb-4">Role: <strong>{{ Auth::user()->role ?? 'admin' }}</strong></p>

                <hr class="my-4 text-secondary">

                <h4 class="fw-bold mb-3">Menu Kasir</h4>
                <ul class="fs-5 lh-lg mb-0 ps-4">
                    <li><a href="{{ route('admin.products.index') }}" class="text-decoration-none text-dark">Melihat produk</a></li>
                    <li><a href="{{ route('cashier.index') }}" class="text-decoration-none text-dark">Mengelola transaksi</a></li>
                    <li><a href="{{ route('cart.index') }}" class="text-decoration-none text-dark">Melakukan checkout</a></li>
                    <li><a href="{{ route('cashier.index') }}" class="text-decoration-none text-dark">Melihat pesanan</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/bootstrap.bundle.min.js"></script>
</body>
</html>