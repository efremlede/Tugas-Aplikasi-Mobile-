<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Toko Semen Jaya</title>

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

        /* Interactive Profile Picture Upload Style */
        .avatar-upload-wrapper {
            position: relative;
            cursor: pointer;
            width: 46px;
            height: 46px;
        }

        .avatar-upload-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border: 2px solid #ea580c;
            transition: all 0.2s ease;
        }

        .avatar-upload-wrapper:hover img {
            filter: brightness(0.85);
        }

        .avatar-upload-wrapper .upload-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: rgba(0, 0, 0, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-size: 0.75rem;
            opacity: 0;
            transition: opacity 0.2s ease;
        }

        .avatar-upload-wrapper:hover .upload-overlay {
            opacity: 1;
        }

        /* Banner Hero Cement Charcoal & Industrial Orange */
        .hero-banner {
            background: linear-gradient(135deg, #1e293b 0%, #334155 60%, #0f172a 100%); /* Concrete Charcoal Base */
            border-radius: 24px;
            padding: 40px;
            color: #ffffff;
            box-shadow: 0 12px 32px -8px rgba(15, 23, 42, 0.4);
            position: relative;
            overflow: hidden;
            border-left: 8px solid #f97316; /* Orange Cement Line */
        }

        .hero-banner::after {
            content: '🧱';
            position: absolute;
            right: 30px;
            top: 20px;
            font-size: 8rem;
            opacity: 0.15;
            pointer-events: none;
        }

        .badge-pelanggan {
            background: rgba(249, 115, 22, 0.25);
            backdrop-filter: blur(8px);
            border: 1px solid #f97316;
            color: #ffedd5;
            border-radius: 30px;
            padding: 6px 16px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Cards Statistic */
        .card-stat {
            background: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 20px;
            padding: 24px;
            height: 100%;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
            transition: transform 0.2s ease;
        }

        .card-stat:hover {
            transform: translateY(-2px);
        }

        .icon-stat-box {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            background: #fff7ed;
            color: #ea580c;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            border: 1px solid #ffedd5;
        }

        /* Delivery Tracker Card Rapi */
        .tracker-card {
            background: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 20px;
            padding: 28px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        }

        /* Step Progress Bar Tracker Rapi Tanpa Bentrok */
        .progress-tracker-container {
            position: relative;
            padding: 20px 0;
            margin: 20px 0;
        }

        .tracker-line-bg {
            position: absolute;
            top: 35px;
            left: 5%;
            width: 90%;
            height: 6px;
            background-color: #e2e8f0;
            border-radius: 10px;
            z-index: 1;
        }

        .tracker-line-fill {
            position: absolute;
            top: 35px;
            left: 5%;
            width: 60%; /* Progres Pengiriman */
            height: 6px;
            background: linear-gradient(90deg, #f97316 0%, #ea580c 100%);
            border-radius: 10px;
            z-index: 2;
        }

        .tracker-steps-wrapper {
            position: relative;
            z-index: 3;
            display: flex;
            justify-content: space-between;
        }

        .tracker-step-item {
            text-align: center;
            flex: 1;
        }

        .tracker-node {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: #ffffff;
            border: 3px solid #cbd5e1;
            color: #94a3b8;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            margin-bottom: 8px;
            transition: all 0.3s ease;
        }

        .tracker-step-item.active .tracker-node {
            background-color: #ea580c;
            border-color: #ffedd5;
            color: #ffffff;
            box-shadow: 0 0 0 4px rgba(234, 88, 12, 0.2);
        }

        .tracker-label {
            font-size: 0.825rem;
            font-weight: 700;
            color: #94a3b8;
        }

        .tracker-step-item.active .tracker-label {
            color: #ea580c;
        }

        .tracker-info-box {
            background: #f8fafc;
            border: 1px solid #cbd5e1;
            border-radius: 14px;
            padding: 16px 20px;
        }

        /* Orange Action Button */
        .btn-orange-cement {
            background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
            color: #ffffff !important;
            border: none;
            box-shadow: 0 4px 14px rgba(234, 88, 12, 0.4);
            transition: all 0.2s ease;
        }

        .btn-orange-cement:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(234, 88, 12, 0.5);
        }
    </style>
</head>
<body>

    <!-- Header Navbar dengan Foto Profil yang BISA DIKLIK untuk pilih dari File Explorer -->
    <header class="top-navbar d-flex justify-content-between align-items-center shadow-sm">
        
        <!-- Foto Profil Interaktif & Nama Brand -->
        <div class="d-flex align-items-center gap-3">
            
            <div class="avatar-upload-wrapper" onclick="document.getElementById('avatarInput').click();" title="Klik untuk mengganti foto dari File Explorer">
                <img id="avatarImage" 
                     src="{{ asset('images/profil.jpg') }}" 
                     alt="Foto Profil" 
                     class="rounded-circle shadow-sm"
                     onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name=Semen+Jaya&background=ea580c&color=fff';">
                
                <div class="upload-overlay">
                    <i class="fa-solid fa-camera"></i>
                </div>
            </div>

            <input type="file" id="avatarInput" accept="image/*" style="display: none;" onchange="previewSelectedImage(this)">

            <div>
                <div class="d-flex align-items-center gap-2">
                    <h5 class="fw-bold m-0 text-dark">Semen Jaya</h5>
                    <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle rounded-pill px-2 py-1" style="font-size: 0.65rem;">PELANGGAN</span>
                </div>
                <small class="text-muted fw-semibold" style="font-size: 0.75rem;">DISTRIBUTOR SEMEN RESMI</small>
            </div>
        </div>

        <!-- Pill Navigasi Utama -->
        <div class="nav-pill-container shadow-sm">
            <a href="{{ route('dashboard') }}" class="nav-pill-btn active">
                <i class="fa-solid fa-house"></i> Dashboard
            </a>
            <a href="{{ route('profile.index') }}" class="nav-pill-btn">
                <i class="fa-solid fa-user"></i> Profil Anda
            </a>
            <a href="{{ route('admin.index') }}" class="nav-pill-btn">
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

    <!-- Main Container Content -->
    <div class="container py-4 px-3" style="max-width: 1200px;">

        <!-- 1. Hero Banner Concrete Charcoal & Orange Accent -->
        <div class="hero-banner mb-4">
            <div class="mb-3">
                <span class="badge-pelanggan"><i class="fa-solid fa-box-open me-1"></i> Area Pelanggan</span>
            </div>
            <h1 class="fw-extrabold display-6 mb-2">Selamat Datang, Pelanggan Setia! 🧱</h1>
            <p class="opacity-90 mb-4 col-lg-9 text-light" style="font-size: 0.95rem; line-height: 1.6;">
                Siap untuk melengkapi stok semen bangunan Anda hari ini? Nikmati berbagai pilihan Semen Tiga Roda, Gresik, Padang, dan Dynamix berkualitas super dengan pengiriman armada cepat.
            </p>
            <div class="d-flex flex-wrap gap-3">
                <a href="{{ route('cashier.index') }}" class="btn btn-orange-cement fw-bold px-4 py-2 rounded-pill shadow">
                    <i class="fa-solid fa-cart-shopping me-2"></i> MULAI BELANJA SEKARANG
                </a>
                <a href="{{ route('profile.index') }}" class="btn btn-outline-light fw-semibold px-4 py-2 rounded-pill">
                    <i class="fa-solid fa-user-gear me-2"></i> Pengaturan Akun
                </a>
            </div>
        </div>

        <!-- 2. Ringkasan 3 Stat Cards -->
        <div class="row g-3 mb-4">
            <!-- Card 1: Poin Reward -->
            <div class="col-md-4">
                <div class="card-stat">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <span class="text-uppercase text-muted fw-bold" style="font-size: 0.725rem; letter-spacing: 0.5px;">POIN REWARD</span>
                            <div class="d-flex align-items-baseline gap-1 mt-1">
                                <h2 class="fw-extrabold m-0 text-dark">120</h2>
                                <span class="fw-bold text-secondary" style="font-size: 0.9rem;">Pts</span>
                            </div>
                            <small class="text-warning-emphasis fw-semibold mt-2 d-block" style="font-size: 0.75rem;">
                                <i class="fa-solid fa-coins me-1 text-warning"></i> Siap ditukarkan voucher
                            </small>
                        </div>
                        <div class="icon-stat-box">
                            <i class="fa-solid fa-coins"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 2: Pesanan Aktif -->
            <div class="col-md-4">
                <div class="card-stat">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <span class="text-uppercase text-muted fw-bold" style="font-size: 0.725rem; letter-spacing: 0.5px;">PESANAN AKTIF</span>
                            <div class="d-flex align-items-baseline gap-2 mt-1">
                                <h2 class="fw-extrabold m-0 text-dark">1</h2>
                                <span class="fw-bold text-dark" style="font-size: 0.9rem;">Pengiriman</span>
                            </div>
                            <small class="text-muted fw-semibold mt-2 d-block" style="font-size: 0.75rem;">
                                <i class="fa-solid fa-truck-fast me-1 text-dark"></i> Kurir menuju lokasi Anda
                            </small>
                        </div>
                        <div class="icon-stat-box">
                            <i class="fa-solid fa-box"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 3: Total Transaksi -->
            <div class="col-md-4">
                <div class="card-stat">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <span class="text-uppercase text-muted fw-bold" style="font-size: 0.725rem; letter-spacing: 0.5px;">TOTAL TRANSAKSI</span>
                            <div class="d-flex align-items-baseline gap-2 mt-1">
                                <h2 class="fw-extrabold m-0 text-dark">5</h2>
                                <span class="fw-bold text-dark" style="font-size: 0.9rem;">Selesai</span>
                            </div>
                            <small class="text-success fw-semibold mt-2 d-block" style="font-size: 0.75rem;">
                                <i class="fa-solid fa-circle-check me-1"></i> Transaksi terverifikasi
                            </small>
                        </div>
                        <div class="icon-stat-box">
                            <i class="fa-solid fa-receipt"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. Section Status Pesanan Terakhir (Tracker Pengiriman Rapi) -->
        <div class="tracker-card">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div class="d-flex align-items-center gap-3">
                    <div class="icon-stat-box rounded-3" style="width: 42px; height: 42px;">
                        <i class="fa-solid fa-truck-ramp-box"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold m-0 text-dark">Status Pesanan Terakhir</h6>
                        <small class="text-muted">Pantau pergerakan pengiriman semen bangunan Anda secara real-time</small>
                    </div>
                </div>
                <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle fw-bold px-3 py-2 rounded-pill" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                    SEDANG DIKIRIM
                </span>
            </div>

            <!-- Step Progress Bar Tracker Terpisah Rapi -->
            <div class="progress-tracker-container">
                <div class="tracker-line-bg"></div>
                <div class="tracker-line-fill"></div>
                
                <div class="tracker-steps-wrapper">
                    <!-- Step 1 -->
                    <div class="tracker-step-item active">
                        <div class="tracker-node"><i class="fa-solid fa-check"></i></div>
                        <div class="tracker-label">Diproses</div>
                    </div>
                    <!-- Step 2 -->
                    <div class="tracker-step-item active">
                        <div class="tracker-node"><i class="fa-solid fa-box"></i></div>
                        <div class="tracker-label">Dikemas</div>
                    </div>
                    <!-- Step 3 -->
                    <div class="tracker-step-item active">
                        <div class="tracker-node"><i class="fa-solid fa-truck-fast"></i></div>
                        <div class="tracker-label">Dalam Perjalanan</div>
                    </div>
                    <!-- Step 4 -->
                    <div class="tracker-step-item">
                        <div class="tracker-node"><i class="fa-solid fa-house-chimney"></i></div>
                        <div class="tracker-label">Diterima</div>
                    </div>
                </div>
            </div>

            <!-- Detail Box Rincian Pesanan Terakhir -->
            <div class="row g-3">
                <div class="col-md-3">
                    <div class="tracker-info-box">
                        <small class="text-muted d-block" style="font-size: 0.7rem;">Nomor Pesanan</small>
                        <strong class="text-dark" style="font-size: 0.85rem;">#SMJ-20261020</strong>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="tracker-info-box">
                        <small class="text-muted d-block" style="font-size: 0.7rem;">Item Pesanan</small>
                        <strong class="text-dark" style="font-size: 0.85rem;">20x Semen Tiga Roda 50kg</strong>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="tracker-info-box">
                        <small class="text-muted d-block" style="font-size: 0.7rem;">Total Pembayaran</small>
                        <strong class="text-dark" style="font-size: 0.85rem;">Rp 1.300.000</strong>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="tracker-info-box">
                        <small class="text-muted d-block" style="font-size: 0.7rem;">Estimasi Tiba</small>
                        <strong class="text-dark" style="font-size: 0.85rem;">Hari ini, 14:00 WITA</strong>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/bootstrap.bundle.min.js"></script>

    <!-- JavaScript Preview Foto dari File Explorer -->
    <script>
        function previewSelectedImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('avatarImage').src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>