<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pelanggan - Toko Semen Jaya</title>

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

        /* Profile Header Banner */
        .profile-banner {
            background: linear-gradient(135deg, #1e293b 0%, #334155 60%, #0f172a 100%);
            border-radius: 20px 20px 0 0;
            height: 120px;
            position: relative;
            border-left: 6px solid #ea580c;
        }

        .profile-card {
            background: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 20px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
            overflow: hidden;
        }

        /* Avatar Upload Container Utama */
        .avatar-main-container {
            width: 100px;
            height: 100px;
            margin: -50px auto 12px;
        }

        .avatar-main-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border: 4px solid #ffffff;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        /* Form Controls Custom */
        .input-group-text {
            background-color: #f8fafc;
            border-color: #cbd5e1;
            color: #64748b;
        }

        .form-control {
            border-color: #cbd5e1;
            padding: 10px 14px;
            font-size: 0.9rem;
        }

        .form-control:focus {
            border-color: #ea580c;
            box-shadow: 0 0 0 0.25rem rgba(234, 88, 12, 0.15);
        }

        /* Stat Box Grid */
        .stat-mini-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 12px 16px;
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

    <!-- Top Navbar -->
    <header class="top-navbar d-flex justify-content-between align-items-center shadow-sm">
        
        <!-- Logo / Foto Profil Navbar (Bisa diklik untuk buka File Explorer) -->
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
            <input type="file" id="navAvatarInput" accept="image/*" style="display: none;" onchange="syncAndPreviewImage(this)">

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
            <a href="{{ route('dashboard') }}" class="nav-pill-btn">
                <i class="fa-solid fa-house"></i> Dashboard
            </a>
            <a href="{{ route('profile.index') }}" class="nav-pill-btn active">
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

    <!-- Main Content Profil -->
    <div class="container py-4 px-3" style="max-width: 1080px;">

        <div class="row g-4">
            <!-- Left Column: Kartu Informasi Akun Ringkas -->
            <div class="col-lg-4">
                <div class="profile-card">
                    <div class="profile-banner"></div>

                    <div class="p-4 pt-0 text-center position-relative">
                        <!-- Foto Profil Kartu Utama (Bisa diklik untuk buka File Explorer) -->
                        <div class="avatar-clickable avatar-main-container" onclick="document.getElementById('cardAvatarInput').click();" title="Klik untuk mengganti foto dari File Explorer">
                            <img id="cardAvatarImage" 
                                 src="{{ asset('images/profil.jpg') }}" 
                                 alt="Foto Profil" 
                                 onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'Kasir Jaya') }}&background=ea580c&color=fff';">
                            <div class="hover-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center text-white opacity-0" style="background: rgba(0,0,0,0.4); transition: opacity 0.2s;">
                                <i class="fa-solid fa-camera fs-5"></i>
                            </div>
                        </div>

                        <!-- Input File Tersembunyi Kartu -->
                        <input type="file" id="cardAvatarInput" accept="image/*" style="display: none;" onchange="syncAndPreviewImage(this)">

                        <h5 class="fw-bold m-0 text-dark">{{ Auth::user()->name ?? 'Kasir Jaya' }}</h5>
                        <p class="text-muted small mb-3">{{ Auth::user()->email ?? 'e44253240@student.polije.ac.id' }}</p>
                        
                        <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1 rounded-pill fw-semibold">
                            <i class="fa-solid fa-circle-check me-1"></i> Status Akun: Aktif
                        </span>

                        <hr class="my-4">

                        <!-- Detail Grid Status -->
                        <div class="row g-2 text-start">
                            <div class="col-6">
                                <div class="stat-mini-box">
                                    <small class="text-muted d-block fw-bold" style="font-size: 0.675rem;">ROLE PENGGUNA</small>
                                    <strong class="text-dark text-capitalize" style="font-size: 0.85rem;">{{ Auth::user()->role ?? 'Admin' }}</strong>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="stat-mini-box">
                                    <small class="text-muted d-block fw-bold" style="font-size: 0.675rem;">MEMBER SEJAK</small>
                                    <strong class="text-dark" style="font-size: 0.85rem;">2026</strong>
                                </div>
                            </div>
                            <div class="col-6 mt-2">
                                <div class="stat-mini-box">
                                    <small class="text-muted d-block fw-bold" style="font-size: 0.675rem;">POIN REWARD</small>
                                    <strong class="text-warning-emphasis" style="font-size: 0.85rem;"><i class="fa-solid fa-coins me-1"></i> 120 Pts</strong>
                                </div>
                            </div>
                            <div class="col-6 mt-2">
                                <div class="stat-mini-box">
                                    <small class="text-muted d-block fw-bold" style="font-size: 0.675rem;">TRANSAKSI</small>
                                    <strong class="text-primary" style="font-size: 0.85rem;"><i class="fa-solid fa-receipt me-1"></i> 5 Selesai</strong>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Right Column: Form Pengaturan Akun & Kontak -->
            <div class="col-lg-8">
                <div class="profile-card p-4">
                    
                    <div class="d-flex align-items-center justify-content-between mb-4 pb-3 border-bottom">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-warning-subtle text-warning-emphasis p-2 rounded-3 fs-5 d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                                <i class="fa-solid fa-id-card"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold m-0 text-dark">Pengaturan Akun & Informasi Profil</h5>
                                <small class="text-muted">Perbarui data diri dan alamat pengiriman semen Anda</small>
                            </div>
                        </div>
                        <span class="badge bg-light text-secondary border px-3 py-2 rounded-pill small fw-semibold">
                            ID: #USR-8821
                        </span>
                    </div>

                    <form action="#" method="POST">
                        @csrf
                        <div class="row g-3">
                            
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small text-dark">Nama Lengkap / Toko</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                    <input type="text" class="form-control" value="{{ Auth::user()->name ?? 'Kasir' }}" placeholder="Masukkan nama Anda">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold small text-dark">Alamat Email</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                                    <input type="email" class="form-control" value="{{ Auth::user()->email ?? 'e44253240@student.polije.ac.id' }}" placeholder="Masukkan email">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label fw-semibold small text-dark">Nomor Telepon / WhatsApp</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                                    <input type="text" class="form-control" value="081234567890" placeholder="Masukkan nomor telepon">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label fw-semibold small text-dark">Alamat Pengiriman Semen Utama</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-location-dot"></i></span>
                                    <textarea class="form-control" rows="3" placeholder="Masukkan alamat lengkap proyek/toko Anda">Jl. Raya Industri Semen No. 45, Kalimantan Timur</textarea>
                                </div>
                            </div>

                        </div>

                        <div class="d-flex justify-content-end align-items-center gap-2 mt-4 pt-3 border-top">
                            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary rounded-pill px-4 fw-semibold">
                                <i class="fa-solid fa-xmark me-1"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-orange-cement rounded-pill px-4 fw-bold">
                                <i class="fa-solid fa-floppy-disk me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/bootstrap.bundle.min.js"></script>

    <!-- JavaScript Sinkronisasi & Preview Foto dari File Explorer -->
    <script>
        function syncAndPreviewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const newImageSrc = e.target.result;
                    document.getElementById('navAvatarImage').src = newImageSrc;
                    document.getElementById('cardAvatarImage').src = newImageSrc;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>