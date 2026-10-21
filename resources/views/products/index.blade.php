<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Produk - Toko Semen Jaya</title>

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

        /* Data Tables Container Card */
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
            padding: 16px 20px;
            border-bottom: 2px solid #e2e8f0;
        }

        .table-custom td {
            padding: 16px 20px;
            vertical-align: middle;
            font-size: 0.875rem;
            border-bottom: 1px solid #f1f5f9;
        }

        /* Standalone Custom Modal */
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
            max-width: 520px;
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

        .product-icon-box {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: #fff7ed;
            color: #ea580c;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            border: 1px solid #ffedd5;
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
                <small class="text-muted fw-semibold" style="font-size: 0.75rem;">INVENTARIS & STOK PRODUK</small>
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
            <a href="{{ route('admin.index') }}" class="nav-pill-btn">
                <i class="fa-solid fa-user-gear"></i> Admin
            </a>
            <a href="{{ route('admin.products.index') }}" class="nav-pill-btn active">
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

    <!-- Main Container Content Produk -->
    <div class="container py-4 px-3" style="max-width: 1180px;">

        <!-- Header Judul Modul & Tombol Tambah Produk -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            <div>
                <div class="d-flex align-items-center gap-2">
                    <h3 class="fw-extrabold text-dark m-0">Katalog & Stok Produk</h3>
                    <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-3 py-1 rounded-pill fw-bold" style="font-size: 0.75rem;">
                        5 Produk Aktif
                    </span>
                </div>
                <p class="text-muted small m-0 mt-1">Kelola varian harga, ketersediaan stok sak semen, dan status penjualan toko Anda.</p>
            </div>

            <button type="button" class="btn btn-orange-cement rounded-pill px-4 py-2 fw-bold" onclick="showAddProductModal()">
                <i class="fa-solid fa-plus me-1"></i> Tambah Produk Baru
            </button>
        </div>

        <!-- Filtering & Search Bar -->
        <div class="bg-white p-3 rounded-4 border mb-4 shadow-sm d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div class="input-group" style="max-width: 380px;">
                <span class="input-group-text bg-light border-end-0 text-muted"><i class="fa-solid fa-magnifying-glass"></i></span>
                <input type="text" id="searchInput" class="form-control border-start-0 bg-light" placeholder="Cari nama semen (Kupang, Tiga Roda, Dynamix)..." onkeyup="filterProducts()">
            </div>

            <div class="d-flex align-items-center gap-2">
                <span class="text-muted small fw-semibold">Kategori:</span>
                <select class="form-select form-select-sm rounded-pill px-3" style="width: auto;">
                    <option value="all">Semua Kategori Semen</option>
                    <option value="semen">Semen Portland / Sak</option>
                    <option value="putih">Semen Putih</option>
                </select>
            </div>
        </div>

        <!-- Tabel Data Produk Terstruktur -->
        <div class="custom-table-card">
            <div class="table-responsive">
                <table class="table table-custom align-middle m-0" id="productsTable">
                    <thead>
                        <tr>
                            <th style="width: 60px;">No</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Harga per Sak</th>
                            <th>Stok Ketersediaan</th>
                            <th>Status Penjualan</th>
                            <th class="text-end" style="width: 180px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="productTableBody">
                        <!-- Item 1 -->
                        <tr>
                            <td class="fw-bold text-muted">1</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="product-icon-box">
                                        <i class="fa-solid fa-cubes"></i>
                                    </div>
                                    <div>
                                        <strong class="text-dark d-block fw-bold product-name">Semen Kupang 40 kg</strong>
                                        <small class="text-muted" style="font-size: 0.725rem;">SKU: #SMN-KPG-40</small>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge bg-light text-dark border px-3 py-1 rounded-pill fw-semibold product-category">Semen Portland</span></td>
                            <td><strong class="text-dark product-price" style="font-size: 0.95rem;">Rp 65.000</strong></td>
                            <td>
                                <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1 rounded-pill fw-bold product-stock">
                                    50 Sak
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-success text-white px-3 py-1 rounded-pill fw-bold product-status" style="font-size: 0.7rem;">
                                    AKTIF
                                </span>
                            </td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-warning rounded-pill px-3 me-1 fw-bold" onclick="editProductModal(this)">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </button>
                                <button class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-bold" onclick="deleteRow(this);">
                                    <i class="fa-solid fa-trash"></i> Hapus
                                </button>
                            </td>
                        </tr>

                        <!-- Item 2 -->
                        <tr>
                            <td class="fw-bold text-muted">2</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="product-icon-box">
                                        <i class="fa-solid fa-cubes"></i>
                                    </div>
                                    <div>
                                        <strong class="text-dark d-block fw-bold product-name">Semen Tiga Roda 50kg</strong>
                                        <small class="text-muted" style="font-size: 0.725rem;">SKU: #SMN-3RD-50</small>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge bg-light text-dark border px-3 py-1 rounded-pill fw-semibold product-category">Semen Portland</span></td>
                            <td><strong class="text-dark product-price" style="font-size: 0.95rem;">Rp 84.971</strong></td>
                            <td>
                                <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1 rounded-pill fw-bold product-stock">
                                    50 Sak
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-success text-white px-3 py-1 rounded-pill fw-bold product-status" style="font-size: 0.7rem;">
                                    AKTIF
                                </span>
                            </td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-warning rounded-pill px-3 me-1 fw-bold" onclick="editProductModal(this)">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </button>
                                <button class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-bold" onclick="deleteRow(this);">
                                    <i class="fa-solid fa-trash"></i> Hapus
                                </button>
                            </td>
                        </tr>

                        <!-- Item 3 -->
                        <tr>
                            <td class="fw-bold text-muted">3</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="product-icon-box">
                                        <i class="fa-solid fa-cubes"></i>
                                    </div>
                                    <div>
                                        <strong class="text-dark d-block fw-bold product-name">Dynamix 50 kg</strong>
                                        <small class="text-muted" style="font-size: 0.725rem;">SKU: #SMN-DNM-50</small>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge bg-light text-dark border px-3 py-1 rounded-pill fw-semibold product-category">Semen Portland</span></td>
                            <td><strong class="text-dark product-price" style="font-size: 0.95rem;">Rp 65.000</strong></td>
                            <td>
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-1 rounded-pill fw-bold product-stock">
                                    18 Sak
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-success text-white px-3 py-1 rounded-pill fw-bold product-status" style="font-size: 0.7rem;">
                                    AKTIF
                                </span>
                            </td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-warning rounded-pill px-3 me-1 fw-bold" onclick="editProductModal(this)">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </button>
                                <button class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-bold" onclick="deleteRow(this);">
                                    <i class="fa-solid fa-trash"></i> Hapus
                                </button>
                            </td>
                        </tr>

                        <!-- Item 4 -->
                        <tr>
                            <td class="fw-bold text-muted">4</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="product-icon-box">
                                        <i class="fa-solid fa-cubes"></i>
                                    </div>
                                    <div>
                                        <strong class="text-dark d-block fw-bold product-name">Semen Padang 40 kg</strong>
                                        <small class="text-muted" style="font-size: 0.725rem;">SKU: #SMN-PDG-40</small>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge bg-light text-dark border px-3 py-1 rounded-pill fw-semibold product-category">Semen Portland</span></td>
                            <td><strong class="text-dark product-price" style="font-size: 0.95rem;">Rp 55.000</strong></td>
                            <td>
                                <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1 rounded-pill fw-bold product-stock">
                                    50 Sak
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-success text-white px-3 py-1 rounded-pill fw-bold product-status" style="font-size: 0.7rem;">
                                    AKTIF
                                </span>
                            </td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-warning rounded-pill px-3 me-1 fw-bold" onclick="editProductModal(this)">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </button>
                                <button class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-bold" onclick="deleteRow(this);">
                                    <i class="fa-solid fa-trash"></i> Hapus
                                </button>
                            </td>
                        </tr>

                        <!-- Item 5 -->
                        <tr>
                            <td class="fw-bold text-muted">5</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="product-icon-box">
                                        <i class="fa-solid fa-cubes"></i>
                                    </div>
                                    <div>
                                        <strong class="text-dark d-block fw-bold product-name">Semen Putih Tiga Roda 40 kg</strong>
                                        <small class="text-muted" style="font-size: 0.725rem;">SKU: #SMN-PTH-40</small>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge bg-light text-dark border px-3 py-1 rounded-pill fw-semibold product-category">Semen Putih</span></td>
                            <td><strong class="text-dark product-price" style="font-size: 0.95rem;">Rp 100.000</strong></td>
                            <td>
                                <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1 rounded-pill fw-bold product-stock">
                                    46 Sak
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-success text-white px-3 py-1 rounded-pill fw-bold product-status" style="font-size: 0.7rem;">
                                    AKTIF
                                </span>
                            </td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-warning rounded-pill px-3 me-1 fw-bold" onclick="editProductModal(this)">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </button>
                                <button class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-bold" onclick="deleteRow(this);">
                                    <i class="fa-solid fa-trash"></i> Hapus
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- MODAL STANDALONE: FORM TAMBAH / EDIT PRODUK BARU -->
    <div id="customProductModal" class="custom-modal-backdrop">
        <div class="custom-modal-box">
            <div class="p-4 text-white d-flex align-items-center justify-content-between" style="background: linear-gradient(135deg, #1e293b, #334155);">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-warning-subtle text-warning-emphasis p-2 rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                        <i id="modalHeaderIcon" class="fa-solid fa-box-open fs-5"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold m-0" id="modalTitleText">Tambah Produk Semen Baru</h5>
                        <small class="text-light opacity-75" id="modalSubtext">Input varian semen dan ketersediaan stok</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" onclick="hideAddProductModal()"></button>
            </div>

            <form id="formAddProduct" onsubmit="saveNewProduct(event)">
                <div class="p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark">Nama Produk Semen</label>
                        <input type="text" id="newProdName" class="form-control rounded-3" placeholder="Contoh: Semen Gresik 50 kg" required>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold small text-dark">Kategori</label>
                            <select id="newProdCategory" class="form-select rounded-3">
                                <option value="Semen Portland">Semen Portland</option>
                                <option value="Semen Putih">Semen Putih</option>
                                <option value="Bahan Bangunan">Bahan Bangunan</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold small text-dark">Harga (Rp)</label>
                            <input type="number" id="newProdPrice" class="form-control rounded-3" placeholder="75000" required>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold small text-dark">Jumlah Stok Sak</label>
                            <input type="number" id="newProdStock" class="form-control rounded-3" placeholder="50" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold small text-dark">Status</label>
                            <select id="newProdStatus" class="form-select rounded-3">
                                <option value="AKTIF">AKTIF</option>
                                <option value="NONAKTIF">NONAKTIF</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="bg-light p-3 border-top d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4 fw-semibold" onclick="hideAddProductModal()">Batal</button>
                    <button type="submit" class="btn btn-orange-cement rounded-pill px-4 fw-bold">
                        <i class="fa-solid fa-floppy-disk me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Pustaka JS Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/bootstrap.bundle.min.js"></script>

    <!-- Script JavaScript Interaktif Modal & Edit Produk -->
    <script>
        let editingRow = null;

        function showAddProductModal() {
            editingRow = null;
            document.getElementById('modalTitleText').innerText = 'Tambah Produk Semen Baru';
            document.getElementById('modalSubtext').innerText = 'Input varian semen dan ketersediaan stok';
            document.getElementById('modalHeaderIcon').className = 'fa-solid fa-box-open fs-5';
            document.getElementById('formAddProduct').reset();
            document.getElementById('customProductModal').classList.add('show');
        }

        function editProductModal(button) {
            editingRow = button.closest('tr');

            const name = editingRow.querySelector('.product-name').innerText;
            const category = editingRow.querySelector('.product-category').innerText;
            const priceText = editingRow.querySelector('.product-price').innerText.replace(/[^0-9]/g, '');
            const stockText = editingRow.querySelector('.product-stock').innerText.replace(/[^0-9]/g, '');
            const status = editingRow.querySelector('.product-status').innerText.trim();

            document.getElementById('modalTitleText').innerText = 'Edit Produk Semen';
            document.getElementById('modalSubtext').innerText = 'Perbarui data varian dan stok semen';
            document.getElementById('modalHeaderIcon').className = 'fa-solid fa-pen-to-square fs-5';

            document.getElementById('newProdName').value = name;
            document.getElementById('newProdCategory').value = category;
            document.getElementById('newProdPrice').value = priceText;
            document.getElementById('newProdStock').value = stockText;
            document.getElementById('newProdStatus').value = status;

            document.getElementById('customProductModal').classList.add('show');
        }

        function hideAddProductModal() {
            document.getElementById('customProductModal').classList.remove('show');
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

        function filterProducts() {
            const input = document.getElementById('searchInput').value.toLowerCase();
            const table = document.getElementById('productsTable');
            const tr = table.getElementsByTagName('tr');

            for (let i = 1; i < tr.length; i++) {
                const tdProduct = tr[i].getElementsByTagName('td')[1];
                if (tdProduct) {
                    const txtValue = tdProduct.textContent || tdProduct.innerText;
                    if (txtValue.toLowerCase().indexOf(input) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        function deleteRow(button) {
            if (confirm('Apakah Anda yakin ingin menghapus produk semen ini?')) {
                const row = button.closest('tr');
                row.remove();
            }
        }

        function saveNewProduct(event) {
            event.preventDefault();

            const name = document.getElementById('newProdName').value;
            const category = document.getElementById('newProdCategory').value;
            const rawPrice = parseInt(document.getElementById('newProdPrice').value);
            const price = rawPrice.toLocaleString('id-ID');
            const stock = document.getElementById('newProdStock').value;
            const status = document.getElementById('newProdStatus').value;

            // Jika Mode Edit Produk
            if (editingRow) {
                editingRow.querySelector('.product-name').innerText = name;
                editingRow.querySelector('.product-category').innerText = category;
                editingRow.querySelector('.product-price').innerText = 'Rp ' + price;
                
                const stockBadge = editingRow.querySelector('.product-stock');
                stockBadge.innerText = stock + ' Sak';
                if (parseInt(stock) <= 20) {
                    stockBadge.className = 'badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-1 rounded-pill fw-bold product-stock';
                } else {
                    stockBadge.className = 'badge bg-success-subtle text-success border border-success-subtle px-3 py-1 rounded-pill fw-bold product-stock';
                }

                editingRow.querySelector('.product-status').innerText = status;
            } else {
                // Mode Tambah Produk Baru
                const tbody = document.getElementById('productTableBody');
                const rowCount = tbody.getElementsByTagName('tr').length + 1;

                const newRowHtml = `
                    <tr>
                        <td class="fw-bold text-muted">${rowCount}</td>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="product-icon-box">
                                    <i class="fa-solid fa-cubes"></i>
                                </div>
                                <div>
                                    <strong class="text-dark d-block fw-bold product-name">${name}</strong>
                                    <small class="text-muted" style="font-size: 0.725rem;">SKU: #SMN-NEW-${rowCount}</small>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge bg-light text-dark border px-3 py-1 rounded-pill fw-semibold product-category">${category}</span></td>
                        <td><strong class="text-dark product-price" style="font-size: 0.95rem;">Rp ${price}</strong></td>
                        <td>
                            <span class="badge ${parseInt(stock) <= 20 ? 'bg-danger-subtle text-danger border border-danger-subtle' : 'bg-success-subtle text-success border border-success-subtle'} px-3 py-1 rounded-pill fw-bold product-stock">
                                ${stock} Sak
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-success text-white px-3 py-1 rounded-pill fw-bold product-status" style="font-size: 0.7rem;">
                                ${status}
                            </span>
                        </td>
                        <td class="text-end">
                            <button class="btn btn-sm btn-outline-warning rounded-pill px-3 me-1 fw-bold" onclick="editProductModal(this)">
                                <i class="fa-solid fa-pen-to-square"></i> Edit
                            </button>
                            <button class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-bold" onclick="deleteRow(this);">
                                <i class="fa-solid fa-trash"></i> Hapus
                            </button>
                        </td>
                    </tr>
                `;

                tbody.insertAdjacentHTML('beforeend', newRowHtml);
            }

            hideAddProductModal();
            document.getElementById('formAddProduct').reset();
        }
    </script>
</body>
</html>