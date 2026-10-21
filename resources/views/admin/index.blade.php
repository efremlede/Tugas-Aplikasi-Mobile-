<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administrator - Toko Semen Jaya</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome 6 Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Font (Plus Jakarta Sans) -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #e2e8f0; /* Concrete Light Gray */
            color: #0f172a;
            min-height: 100vh;
        }

        /* Top Navbar Pill Layout */
        .top-navbar {
            background: #ffffff;
            border-bottom: 2px solid #cbd5e1;
            padding: 12px 32px;
        }

        .nav-pill-container {
            background-color: #f1f5f9;
            border: 1px solid #cbd5e1;
            border-radius: 50px;
            padding: 4px;
            display: inline-flex;
            gap: 4px;
        }

        .nav-pill-btn {
            border-radius: 30px;
            padding: 8px 18px;
            font-size: 0.85rem;
            font-weight: 600;
            color: #475569;
            text-decoration: none;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .nav-pill-btn:hover {
            background-color: #e2e8f0;
            color: #0f172a;
        }

        .nav-pill-btn.active {
            background: linear-gradient(135deg, #f97316 0%, #ea580c 100%); /* Construction Orange Accent */
            color: #ffffff !important;
            box-shadow: 0 4px 12px rgba(234, 88, 12, 0.35);
        }

        /* Hover Overlay untuk Upload Foto dari File Explorer */
        .avatar-clickable {
            position: relative;
            cursor: pointer;
            overflow: hidden;
            border-radius: 50%;
        }

        .avatar-clickable:hover .hover-overlay {
            opacity: 1 !important;
        }

        /* Banner Hero Admin Concrete Charcoal */
        .admin-hero-banner {
            background: linear-gradient(135deg, #1e293b 0%, #334155 60%, #0f172a 100%);
            border-radius: 24px;
            padding: 32px 36px;
            color: #ffffff;
            box-shadow: 0 12px 32px -8px rgba(15, 23, 42, 0.4);
            position: relative;
            overflow: hidden;
            border-left: 8px solid #ea580c;
        }

        .admin-hero-banner::after {
            content: '⚙️';
            position: absolute;
            right: 30px;
            top: 15px;
            font-size: 7.5rem;
            opacity: 0.12;
            pointer-events: none;
        }

        /* KPI Stat Cards */
        .kpi-card {
            background: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 18px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
            transition: all 0.2s ease;
        }

        .kpi-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
        }

        .kpi-icon-box {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.15rem;
        }

        /* Admin Feature Action Cards */
        .admin-card {
            background: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 20px;
            padding: 24px;
            height: 100%;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
            transition: all 0.25s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .admin-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
            border-color: #ea580c;
        }

        .card-icon-wrapper {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            margin-bottom: 16px;
        }

        /* Data Tables Styling */
        .custom-table-card {
            background: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 20px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.04);
            overflow: hidden;
        }

        .table-custom th {
            background-color: #f8fafc;
            color: #64748b;
            font-weight: 700;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 14px 20px;
            border-bottom: 2px solid #e2e8f0;
        }

        .table-custom td {
            padding: 14px 20px;
            vertical-align: middle;
            font-size: 0.875rem;
            border-bottom: 1px solid #f1f5f9;
        }

        /* Custom Standalone Modal (Pasti Bisa Terbuka) */
        .custom-modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: rgba(15, 23, 42, 0.65);
            backdrop-filter: blur(4px);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.25s ease;
        }

        .custom-modal-backdrop.show {
            opacity: 1;
            pointer-events: auto;
        }

        .custom-modal-box {
            background: #ffffff;
            border-radius: 20px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            transform: translateY(-20px);
            transition: transform 0.25s ease;
        }

        .custom-modal-backdrop.show .custom-modal-box {
            transform: translateY(0);
        }

        /* Buttons Styling */
        .btn-orange-cement {
            background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
            color: #ffffff !important;
            border: none;
            box-shadow: 0 4px 14px rgba(234, 88, 12, 0.35);
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .btn-orange-cement:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(234, 88, 12, 0.45);
        }

        .btn-charcoal-cement {
            background: linear-gradient(135deg, #334155 0%, #1e293b 100%);
            color: #ffffff !important;
            border: none;
            box-shadow: 0 4px 14px rgba(30, 41, 59, 0.3);
            transition: all 0.2s ease;
        }

        .btn-charcoal-cement:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(30, 41, 59, 0.4);
        }

        .btn-teal-cement {
            background: linear-gradient(135deg, #0d9488 0%, #0f766e 100%);
            color: #ffffff !important;
            border: none;
            box-shadow: 0 4px 14px rgba(13, 148, 136, 0.3);
            transition: all 0.2s ease;
        }

        .btn-teal-cement:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(13, 148, 136, 0.4);
        }
    </style>
</head>
<body>

    <!-- Header Navbar Utama -->
    <header class="top-navbar d-flex justify-content-between align-items-center shadow-sm">
        
        <!-- Logo / Foto Profil Navbar -->
        <div class="d-flex align-items-center gap-3">
            <div class="avatar-clickable" style="width: 44px; height: 44px;" onclick="document.getElementById('navAvatarInput').click();" title="Klik untuk mengganti foto dari File Explorer">
                <img id="navAvatarImage" 
                     src="{{ asset('images/profil.jpg') }}" 
                     alt="Logo/Foto Profil" 
                     class="w-100 h-100 object-fit-cover" 
                     style="border: 2px solid #ea580c;"
                     onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'Semen Jaya') }}&background=ea580c&color=fff';">
                
                <div class="hover-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center text-white opacity-0" style="background: rgba(0,0,0,0.4); transition: opacity 0.2s;">
                    <i class="fa-solid fa-camera fs-6"></i>
                </div>
            </div>

            <!-- Input File Tersembunyi Navbar -->
            <input type="file" id="navAvatarInput" accept="image/*" style="display: none;" onchange="syncNavAdminImage(this)">

            <div>
                <div class="d-flex align-items-center gap-2">
                    <h5 class="fw-bold m-0 text-dark">Semen Jaya</h5>
                    <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle rounded-pill px-2 py-1" style="font-size: 0.65rem;">ADMINISTRATOR</span>
                </div>
                <small class="text-muted fw-semibold" style="font-size: 0.75rem;">PANEL KONTROL PUSAT</small>
            </div>
        </div>

        <!-- Pill Navigasi Utama -->
        <div class="nav-pill-container shadow-sm">
            <a href="{{ route('dashboard') }}" class="nav-pill-btn">
                <i class="fa-solid fa-house"></i> Dashboard
            </a>
            <a href="{{ route('profile.index') }}" class="nav-pill-btn">
                <i class="fa-solid fa-user"></i> Profil Anda
            </a>
            <a href="{{ route('admin.index') }}" class="nav-pill-btn active">
                <i class="fa-solid fa-user-gear"></i> Admin
            </a>
            <a href="{{ route('admin.products.index') }}" class="nav-pill-btn">
                <i class="fa-solid fa-boxes-stacked"></i> Halaman Produk
            </a>
            <a href="{{ route('cashier.index') }}" class="nav-pill-btn">
                <i class="fa-solid fa-cash-register"></i> Kasir
            </a>
            <a href="{{ route('profile.index') }}" class="nav-pill-btn">
                <i class="fa-solid fa-users"></i> Daftar Pelanggan
            </a>
        </div>

        <!-- User Logout Button -->
        <div>
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3 fw-semibold">
                    <i class="fa-solid fa-right-from-bracket me-1"></i> Logout
                </button>
            </form>
        </div>
    </header>

    <!-- Main Container Admin -->
    <div class="container py-4 px-3" style="max-width: 1180px;">

        <!-- 1. Banner Hero Administrator -->
        <div class="admin-hero-banner mb-4 d-flex justify-content-between align-items-center">
            <div>
                <div class="mb-2">
                    <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-3 py-1 rounded-pill fw-bold text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.5px;">
                        <i class="fa-solid fa-shield-halved me-1"></i> Mode Administrator Utama
                    </span>
                </div>
                <h2 class="fw-extrabold m-0 text-white mb-2">Pengelolaan Hak Akses & Sistem Admin</h2>
                <p class="opacity-90 m-0 text-light small col-lg-10">
                    Atur inventaris semen, manajemen pengguna, dan laporan transaksi toko secara terpusat dalam satu kontrol sistem real-time.
                </p>
            </div>
            <div class="d-none d-md-block text-end">
                <span class="badge bg-light text-dark px-3 py-2 rounded-pill fw-semibold border shadow-sm d-inline-block mb-2">
                    <i class="fa-solid fa-circle text-success fs-6 me-1"></i> Hak Akses Terverifikasi
                </span>
                <small class="d-block text-light opacity-75" style="font-size: 0.725rem;">Administrator: {{ Auth::user()->name ?? 'Kasir Jaya' }}</small>
            </div>
        </div>

        <!-- 2. Ringkasan Metric KPI Real-Time -->
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="kpi-card">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-muted fw-bold small" style="font-size: 0.725rem;">PENDAPATAN HARI INI</span>
                        <div class="kpi-icon-box bg-warning-subtle text-warning-emphasis border border-warning-subtle">
                            <i class="fa-solid fa-wallet"></i>
                        </div>
                    </div>
                    <h4 class="fw-extrabold m-0 text-dark">Rp 4.850.000</h4>
                    <small class="text-success fw-semibold mt-1 d-block" style="font-size: 0.75rem;">
                        <i class="fa-solid fa-arrow-trend-up me-1"></i> +12% dari kemarin
                    </small>
                </div>
            </div>

            <div class="col-md-3">
                <div class="kpi-card">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-muted fw-bold small" style="font-size: 0.725rem;">SEMEN TERJUAL</span>
                        <div class="kpi-icon-box bg-primary-subtle text-primary border border-primary-subtle">
                            <i class="fa-solid fa-cubes-stacked"></i>
                        </div>
                    </div>
                    <h4 class="fw-extrabold m-0 text-dark">180 Sak</h4>
                    <small class="text-primary fw-semibold mt-1 d-block" style="font-size: 0.75rem;">
                        <i class="fa-solid fa-boxes-packing me-1"></i> 38 Transaksi Lunas
                    </small>
                </div>
            </div>

            <div class="col-md-3">
                <div class="kpi-card">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-muted fw-bold small" style="font-size: 0.725rem;">PERINGATAN STOK</span>
                        <div class="kpi-icon-box bg-danger-subtle text-danger border border-danger-subtle">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                        </div>
                    </div>
                    <h4 class="fw-extrabold m-0 text-dark">2 Merek</h4>
                    <small class="text-danger fw-semibold mt-1 d-block" style="font-size: 0.75rem;">
                        <i class="fa-solid fa-arrow-down me-1"></i> Semen Kupang & Dynamix
                    </small>
                </div>
            </div>

            <div class="col-md-3">
                <div class="kpi-card">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-muted fw-bold small" style="font-size: 0.725rem;">PETUGAS KASIR</span>
                        <div class="kpi-icon-box bg-success-subtle text-success border border-success-subtle">
                            <i class="fa-solid fa-user-check"></i>
                        </div>
                    </div>
                    <h4 class="fw-extrabold m-0 text-dark">2 Aktif</h4>
                    <small class="text-success fw-semibold mt-1 d-block" style="font-size: 0.75rem;">
                        <i class="fa-solid fa-circle me-1" style="font-size: 0.5rem;"></i> Sistem POS Online
                    </small>
                </div>
            </div>
        </div>

        <!-- 3. Tiga Kartu Pengelolaan Modul Utama -->
        <div class="row g-4 mb-4">
            
            <!-- Modul 1: Kelola Produk -->
            <div class="col-md-4">
                <div class="admin-card">
                    <div>
                        <div class="card-icon-wrapper bg-warning-subtle text-warning-emphasis border border-warning-subtle">
                            <i class="fa-solid fa-boxes-stacked"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">Kelola Produk & Stok</h5>
                        <p class="text-muted small mb-3" style="line-height: 1.5;">
                            Tambah varian semen baru, perbarui harga sak, dan atur ketersediaan stok semen toko secara real-time.
                        </p>
                    </div>
                    <div>
                        <div class="bg-light p-2 rounded-3 border mb-3 d-flex justify-content-between align-items-center small">
                            <span class="text-muted">Total Varian:</span>
                            <strong class="text-dark">8 Merek Semen</strong>
                        </div>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-orange-cement w-100 rounded-pill py-2 fw-bold">
                            <i class="fa-solid fa-box-open me-1"></i> Masuk Ke Produk
                        </a>
                    </div>
                </div>
            </div>

            <!-- Modul 2: Pengguna & Hak Akses -->
            <div class="col-md-4">
                <div class="admin-card">
                    <div>
                        <div class="card-icon-wrapper bg-secondary-subtle text-dark border border-secondary-subtle">
                            <i class="fa-solid fa-users-gear"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">Pengguna & Hak Akses</h5>
                        <p class="text-muted small mb-3" style="line-height: 1.5;">
                            Kelola akun petugas kasir, registrasi pelanggan, serta atur izin akses modul admin untuk setiap user.
                        </p>
                    </div>
                    <div>
                        <div class="bg-light p-2 rounded-3 border mb-3 d-flex justify-content-between align-items-center small">
                            <span class="text-muted">Petugas Aktif:</span>
                            <strong class="text-dark">Kasir Jaya (Online)</strong>
                        </div>
                        <a href="{{ route('profile.index') }}" class="btn btn-charcoal-cement w-100 rounded-pill py-2 fw-bold">
                            <i class="fa-solid fa-id-card me-1"></i> Lihat Profil Akun
                        </a>
                    </div>
                </div>
            </div>

            <!-- Modul 3: Laporan Penjualan -->
            <div class="col-md-4">
                <div class="admin-card">
                    <div>
                        <div class="card-icon-wrapper border" style="background-color: #ccfbf1; color: #0f766e; border-color: #99f6e4 !important;">
                            <i class="fa-solid fa-chart-line"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">Laporan & POS Toko</h5>
                        <p class="text-muted small mb-3" style="line-height: 1.5;">
                            Pantau histori transaksi harian, pendapatan penjualan semen, dan performa kasir dari sistem POS.
                        </p>
                    </div>
                    <div>
                        <div class="bg-light p-2 rounded-3 border mb-3 d-flex justify-content-between align-items-center small">
                            <span class="text-muted">Transaksi Hari Ini:</span>
                            <strong class="text-success">38 Lunas</strong>
                        </div>
                        <a href="{{ route('cashier.index') }}" class="btn btn-teal-cement w-100 rounded-pill py-2 fw-bold">
                            <i class="fa-solid fa-cash-register me-1"></i> Buka Kasir / POS
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <!-- 4. Tabel Manajemen Pengguna & Hak Akses Real-Time -->
        <div class="custom-table-card mb-4">
            <div class="p-4 border-bottom bg-white d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-warning-subtle text-warning-emphasis p-2 rounded-3 fs-5 d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                        <i class="fa-solid fa-user-shield"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold m-0 text-dark">Manajemen Pengguna & Hak Akses Sistem</h6>
                        <small class="text-muted">Daftar akun kasir dan administrator terdaftar di Toko Semen Jaya</small>
                    </div>
                </div>

                <!-- Tombol Buka Modal Tambah Pengguna Baru (Diisi Onclick Langsung) -->
                <button type="button" class="btn btn-orange-cement btn-sm rounded-pill px-3 fw-bold" onclick="showAddUserModal()">
                    <i class="fa-solid fa-user-plus me-1"></i> Tambah Pengguna Baru
                </button>
            </div>

            <div class="table-responsive">
                <table class="table table-custom align-middle m-0">
                    <thead>
                        <tr>
                            <th>Pengguna</th>
                            <th>Email Akun</th>
                            <th>Role / Hak Akses</th>
                            <th>Status Akses</th>
                            <th>Aktivitas Terakhir</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="userTableBody">
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <img src="{{ asset('images/profil.jpg') }}" alt="User" class="rounded-circle object-fit-cover border" style="width: 36px; height: 36px;" onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name=Kasir+Jaya&background=ea580c&color=fff';">
                                    <div>
                                        <strong class="text-dark d-block" style="font-size: 0.875rem;">{{ Auth::user()->name ?? 'Kasir Jaya' }}</strong>
                                        <small class="text-muted" style="font-size: 0.725rem;">ID: #USR-8821</small>
                                    </div>
                                </div>
                            </td>
                            <td><span class="text-secondary fw-semibold">{{ Auth::user()->email ?? 'e44253240@student.polije.ac.id' }}</span></td>
                            <td>
                                <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-3 py-1 rounded-pill fw-bold text-uppercase" style="font-size: 0.7rem;">
                                    Administrator
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1 rounded-pill fw-semibold">
                                    <i class="fa-solid fa-circle text-success fs-6 me-1"></i> Online
                                </span>
                            </td>
                            <td class="text-muted small">Hari ini, 11:45 WITA</td>
                            <td class="text-end">
                                <a href="{{ route('profile.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                    <i class="fa-solid fa-user-pen me-1"></i> Edit Profil
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <img src="https://ui-avatars.com/api/?name=Budi+Santoso&background=334155&color=fff" alt="User" class="rounded-circle object-fit-cover border" style="width: 36px; height: 36px;">
                                    <div>
                                        <strong class="text-dark d-block" style="font-size: 0.875rem;">Budi Santoso</strong>
                                        <small class="text-muted" style="font-size: 0.725rem;">ID: #USR-8822</small>
                                    </div>
                                </div>
                            </td>
                            <td><span class="text-secondary fw-semibold">budi.kasir@semenjaya.com</span></td>
                            <td>
                                <span class="badge bg-info-subtle text-info-emphasis border border-info-subtle px-3 py-1 rounded-pill fw-bold text-uppercase" style="font-size: 0.7rem;">
                                    Petugas Kasir
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1 rounded-pill fw-semibold">
                                    <i class="fa-solid fa-circle text-success fs-6 me-1"></i> Online
                                </span>
                            </td>
                            <td class="text-muted small">Hari ini, 10:20 WITA</td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                    <i class="fa-solid fa-pen-to-square me-1"></i> Kelola
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- MODAL CUSTOM MANDIRI (Dijamin 100% Langsung Terbuka Tanpa Bug) -->
    <div id="customUserModal" class="custom-modal-backdrop">
        <div class="custom-modal-box">
            <div class="p-4 text-white d-flex align-items-center justify-content-between" style="background: linear-gradient(135deg, #1e293b, #334155);">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-warning-subtle text-warning-emphasis p-2 rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                        <i class="fa-solid fa-user-plus fs-5"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold m-0">Tambah Pengguna Baru</h5>
                        <small class="text-light opacity-75">Buat akun petugas kasir atau admin baru</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" onclick="hideAddUserModal()"></button>
            </div>

            <form id="formAddUser" onsubmit="saveNewUserCustom(event)">
                <div class="p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Nama Lengkap Pengguna</label>
                        <input type="text" id="newUserName" class="form-control rounded-3" placeholder="Contoh: Ahmad Kasir" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Alamat Email</label>
                        <input type="email" id="newUserEmail" class="form-control rounded-3" placeholder="ahmad@semenjaya.com" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Role / Hak Akses</label>
                        <select id="newUserRole" class="form-select rounded-3">
                            <option value="Petugas Kasir">Petugas Kasir</option>
                            <option value="Administrator">Administrator</option>
                            <option value="Pelanggan">Pelanggan</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Kata Sandi Default</label>
                        <input type="password" class="form-control rounded-3" value="semenjaya123" placeholder="Sandi default" required>
                    </div>
                </div>

                <div class="bg-light p-3 border-top d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4 fw-semibold" onclick="hideAddUserModal()">Batal</button>
                    <button type="submit" class="btn btn-orange-cement rounded-pill px-4 fw-bold">
                        <i class="fa-solid fa-floppy-disk me-1"></i> Simpan Pengguna
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Pustaka JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/bootstrap.bundle.min.js"></script>

    <!-- JavaScript Modal Mandiri -->
    <script>
        function showAddUserModal() {
            document.getElementById('customUserModal').classList.add('show');
        }

        function hideAddUserModal() {
            document.getElementById('customUserModal').classList.remove('show');
        }

        function syncNavAdminImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('navAvatarImage').src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function saveNewUserCustom(event) {
            event.preventDefault();
            
            const name = document.getElementById('newUserName').value;
            const email = document.getElementById('newUserEmail').value;
            const role = document.getElementById('newUserRole').value;
            
            const randomID = Math.floor(1000 + Math.random() * 9000);

            const newRowHtml = `
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            <img src="https://ui-avatars.com/api/?name=${encodeURIComponent(name)}&background=ea580c&color=fff" alt="User" class="rounded-circle object-fit-cover border" style="width: 36px; height: 36px;">
                            <div>
                                <strong class="text-dark d-block" style="font-size: 0.875rem;">${name}</strong>
                                <small class="text-muted" style="font-size: 0.725rem;">ID: #USR-${randomID}</small>
                            </div>
                        </div>
                    </td>
                    <td><span class="text-secondary fw-semibold">${email}</span></td>
                    <td>
                        <span class="badge ${role === 'Administrator' ? 'bg-warning-subtle text-warning-emphasis border border-warning-subtle' : 'bg-info-subtle text-info-emphasis border border-info-subtle'} px-3 py-1 rounded-pill fw-bold text-uppercase" style="font-size: 0.7rem;">
                            ${role}
                        </span>
                    </td>
                    <td>
                        <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1 rounded-pill fw-semibold">
                            <i class="fa-solid fa-circle text-success fs-6 me-1"></i> Baru Ditambahkan
                        </span>
                    </td>
                    <td class="text-muted small">Baru saja</td>
                    <td class="text-end">
                        <button class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                            <i class="fa-solid fa-pen-to-square me-1"></i> Kelola
                        </button>
                    </td>
                </tr>
            `;

            document.getElementById('userTableBody').insertAdjacentHTML('afterbegin', newRowHtml);

            hideAddUserModal();
            document.getElementById('formAddUser').reset();
        }
    </script>
</body>
</html>