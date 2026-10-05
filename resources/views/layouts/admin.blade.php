<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Toko Semen Jaya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-color: #0d6efd;
            --sidebar-bg: #1e293b;
            --sidebar-hover: #334155;
        }
        body {
            background-color: #f8fafc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: var(--sidebar-bg);
            z-index: 1000;
        }
        .sidebar .nav-link {
            color: #94a3b8;
            padding: 12px 20px;
            font-weight: 500;
            border-radius: 8px;
            margin: 4px 15px;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            color: #fff;
            background-color: var(--sidebar-hover);
        }
        .main-content {
            margin-left: 250px;
            padding: 30px;
        }
        .card-stat {
            border: none;
            border-radius: 12px;
            transition: transform 0.2s ease;
        }
        .card-stat:hover {
            transform: translateY(-5px);
        }
        .icon-box {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }
    </style>
</head>
<body>

    <!-- Sidebar Navigasi -->
    <div class="sidebar d-flex flex-column justify-content-between py-3">
        <div>
            <div class="px-4 mb-4 text-white d-flex align-items-center gap-2">
                <i class="fa-solid fa-boxes-stacked fa-lg text-primary"></i>
                <span class="fs-5 fw-bold">Semen Jaya</span>
            </div>
            <nav class="nav flex-column">
                <a class="nav-link active" href="#"><i class="fa-solid fa-chart-pie me-2"></i> Dashboard</a>
                <a class="nav-link" href="#"><i class="fa-solid fa-box me-2"></i> Stok Semen</a>
                <a class="nav-link" href="#"><i class="fa-solid fa-cart-shopping me-2"></i> Penjualan</a>
                <a class="nav-link" href="#"><i class="fa-solid fa-users me-2"></i> Kelola User</a>
            </nav>
        </div>
        
        <div class="px-3">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-danger w-100 d-flex align-items-center justify-content-center gap-2">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Area Konten Utama -->
    <div class="main-content">
        <!-- Header Topbar -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-1 text-dark">Dashboard Admin</h3>
                <p class="text-muted mb-0">Selamat datang kembali, pengelola Toko Semen Jaya.</p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="fw-semibold text-dark">{{ Auth::user()->name ?? 'Admin' }}</span>
                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px;">
                    A
                </div>
            </div>
        </div>

        <!-- Cards Ringkasan Statistik -->
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="card card-stat shadow-sm p-3 bg-white">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted small fw-semibold">TOTAL PENJUALAN</span>
                            <h4 class="fw-bold text-dark mt-1 mb-0">Rp 45.250.000</h4>
                        </div>
                        <div class="icon-box bg-primary bg-opacity-10 text-primary">
                            <i class="fa-solid fa-wallet"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-stat shadow-sm p-3 bg-white">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted small fw-semibold">STOK TERSedia</span>
                            <h4 class="fw-bold text-dark mt-1 mb-0">1.280 Sak</h4>
                        </div>
                        <div class="icon-box bg-success bg-opacity-10 text-success">
                            <i class="fa-solid fa-cubes"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-stat shadow-sm p-3 bg-white">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted small fw-semibold">TRANSAKSI HARI INI</span>
                            <h4 class="fw-bold text-dark mt-1 mb-0">24 Transaksi</h4>
                        </div>
                        <div class="icon-box bg-warning bg-opacity-10 text-warning">
                            <i class="fa-solid fa-receipt"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Transaksi -->
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white py-3">
                <h6 class="fw-bold text-dark mb-0"><i class="fa-solid fa-clock-rotate-left me-2 text-primary"></i>Transaksi Terbaru</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">ID Transaksi</th>
                                <th>Kasir</th>
                                <th>Jumlah Semen</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="ps-4 fw-semibold">#TRX-8801</td>
                                <td>Kasir Utama</td>
                                <td>50 Sak Semen Gresik</td>
                                <td class="fw-bold text-dark">Rp 3.250.000</td>
                                <td><span class="badge bg-success-subtle text-success px-2 py-1">Selesai</span></td>
                            </tr>
                            <tr>
                                <td class="ps-4 fw-semibold">#TRX-8802</td>
                                <td>Kasir Utama</td>
                                <td>20 Sak Semen Tiga Roda</td>
                                <td class="fw-bold text-dark">Rp 1.300.000</td>
                                <td><span class="badge bg-success-subtle text-success px-2 py-1">Selesai</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
</html>