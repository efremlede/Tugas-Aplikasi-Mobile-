<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Semen Jaya - Sistem Informasi Kasir</title>
    <!-- Bootstrap 5 CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f1f5f9;
            overflow-x: hidden;
        }

        /* Sidebar Styling Sesuai Gambar Rujukan */
        .sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #5c0d0d; /* Merah gelap industri Toko Semen Jaya */
            color: #ffffff;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .sidebar-brand {
            padding: 24px 20px 16px 20px;
        }

        .sidebar-brand h5 {
            font-weight: 700;
            margin-bottom: 2px;
            font-size: 1.2rem;
            color: #ffffff;
        }

        .sidebar-brand small {
            color: #f87171;
            font-size: 0.75rem;
            display: block;
        }

        .menu-header {
            padding: 15px 20px 8px 20px;
            font-size: 0.7rem;
            font-weight: 700;
            color: #fca5a5;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-menu li a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #fecaca;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.2s ease-in-out;
        }

        .sidebar-menu li a i {
            font-size: 1.1rem;
            margin-right: 12px;
            width: 20px;
            text-align: center;
        }

        /* Hover & Active state */
        .sidebar-menu li a:hover,
        .sidebar-menu li.active a {
            background-color: #450a0a;
            color: #ffffff;
            border-left: 4px solid #ef4444;
        }

        /* Main Content wrapper offset */
        .main-content {
            margin-left: 260px;
            min-height: 100vh;
        }
    </style>
</head>
<body>

    <!-- SIDEBAR KIRI (Sesuai Gambar Rujukan) -->
    <div class="sidebar">
        <div>
            <!-- Header Brand / Nama Toko -->
            <div class="sidebar-brand">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-shop fs-3 text-white"></i>
                    <div>
                        <h5>Toko Semen Jaya</h5>
                        <small>Sistem Informasi Kasir</small>
                    </div>
                </div>
            </div>

            <!-- Header Menu Kasir -->
            <div class="menu-header">MENU KASIR</div>

            <!-- List Menu Navigasi Samping -->
            <ul class="sidebar-menu">
                <li class="{{ request()->is('kasir*') && !request()->is('kasir/riwayat*') ? 'active' : '' }}">
                    <a href="{{ route('cashier.index') }}">
                        <i class="bi bi-cart-plus"></i> Transaksi Baru
                    </a>
                </li>
                <li>
                    <a href="{{ route('cashier.pelanggan') }}">
                        <i class="bi bi-credit-card-2-front"></i> Member NFC
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.products.index') }}">
                        <i class="bi bi-box-seam"></i> Daftar Produk
                    </a>
                </li>
                <li class="{{ request()->is('kasir/riwayat*') ? 'active' : '' }}">
                    <a href="{{ route('cashier.riwayat') }}">
                        <i class="bi bi-clock-history"></i> Riwayat Transaksi
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-bar-chart-line"></i> Laporan
                    </a>
                </li>
            </ul>
        </div>

        <!-- Tombol Logout di Bagian Bawah Sidebar -->
        <div class="p-3">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-light w-100 btn-sm text-start ps-3">
                    <i class="bi bi-box-arrow-right me-2"></i> Keluar
                </button>
            </form>
        </div>
    </div>

    <!-- KONTEN UTAMA (Kanan) -->
    <div class="main-content">
        @yield('content')
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>