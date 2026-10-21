<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Toko Semen Jaya</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Toko Semen Jaya</a>
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('admin.products.index') }}" class="btn btn-outline-light btn-sm">Produk</a>
                <a href="{{ route('cashier.index') }}" class="btn btn-outline-success btn-sm">Kasir / POS</a>
                <span class="text-light ms-2 me-2">Welcome, {{ Auth::user()->name ?? 'Kasir' }}</span>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Content Dashboard -->
    <div class="container py-4">
        <div class="row mb-4">
            <div class="col">
                <h3 class="fw-bold">Selamat Datang di System Kasir</h3>
                <p class="text-muted">Kelola produk dan transaksi Toko Semen Jaya dengan mudah.</p>
            </div>
        </div>

        <!-- Card Statistik Ringkas -->
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm bg-primary text-white p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-1" style="font-size: 0.8rem;">Kelola Produk</h6>
                            <h4 class="fw-bold m-0">Katalog Produk</h4>
                        </div>
                        <i class="fa-solid fa-boxes-stacked fa-2x opacity-50"></i>
                    </div>
                    <a href="{{ route('admin.products.index') }}" class="text-white mt-3 text-decoration-none small fw-semibold">
                        Lihat Daftar Produk <i class="fa-solid fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm bg-success text-white p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-1" style="font-size: 0.8rem;">Mesin Kasir</h6>
                            <h4 class="fw-bold m-0">Transaksi Baru</h4>
                        </div>
                        <i class="fa-solid fa-cash-register fa-2x opacity-50"></i>
                    </div>
                    <a href="{{ route('cashier.index') }}" class="text-white mt-3 text-decoration-none small fw-semibold">
                        Buka Halaman Kasir <i class="fa-solid fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm bg-warning text-dark p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-1" style="font-size: 0.8rem;">Keranjang Belanja</h6>
                            <h4 class="fw-bold m-0">Checkout</h4>
                        </div>
                        <i class="fa-solid fa-cart-shopping fa-2x opacity-50"></i>
                    </div>
                    <a href="{{ route('cart.index') }}" class="text-dark mt-3 text-decoration-none small fw-semibold">
                        Lihat Keranjang <i class="fa-solid fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Banner Selamat Datang -->
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4 text-center">
                <i class="fa-solid fa-store fa-3x text-primary mb-3"></i>
                <h4 class="fw-bold">Aplikasi Toko Semen Jaya Siap Digunakan</h4>
                <p class="text-muted col-md-8 mx-auto">
                    Gunakan menu navigasi di atas atau kartu di atas untuk mengelola data barang, melakukan transaksi penjualan, dan melihat daftar keranjang belanja.
                </p>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/bootstrap.bundle.min.js"></script>
</body>
</html>