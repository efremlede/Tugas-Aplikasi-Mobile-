<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir / POS - Toko Semen Jaya</title>

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

        /* Product Cards POS */
        .product-card-pos {
            background: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 16px rgba(0,0,0,0.04);
            transition: all 0.25s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .product-card-pos:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.08);
            border-color: #ea580c;
        }

        .product-img-box {
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
            height: 150px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            font-size: 2.5rem;
            position: relative;
            border-bottom: 1px solid #e2e8f0;
        }

        .badge-status-pos {
            position: absolute;
            top: 12px;
            left: 12px;
            font-size: 0.65rem;
            letter-spacing: 0.5px;
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

        /* Standalone Custom Offcanvas Keranjang */
        .cart-drawer-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: rgba(15, 23, 42, 0.65);
            backdrop-filter: blur(4px);
            z-index: 9990;
            display: flex;
            justify-content: flex-end;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.25s ease;
        }

        .cart-drawer-backdrop.show {
            opacity: 1;
            pointer-events: auto;
        }

        .cart-drawer-box {
            background: #ffffff;
            width: 100%;
            max-width: 420px;
            height: 100%;
            box-shadow: -10px 0 30px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
            transform: translateX(100%);
            transition: transform 0.25s ease;
        }

        .cart-drawer-backdrop.show .cart-drawer-box {
            transform: translateX(0);
        }

        /* Modal Struk Nota Penjualan */
        .receipt-modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: rgba(15, 23, 42, 0.75);
            backdrop-filter: blur(4px);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.25s ease;
        }

        .receipt-modal-backdrop.show {
            opacity: 1;
            pointer-events: auto;
        }

        .receipt-card {
            background: #ffffff;
            border-radius: 20px;
            width: 100%;
            max-width: 460px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.25);
            overflow: hidden;
            transform: translateY(-20px);
            transition: transform 0.25s ease;
        }

        .receipt-modal-backdrop.show .receipt-card {
            transform: translateY(0);
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
                    <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle rounded-pill px-2 py-1" style="font-size: 0.65rem;">SISTEM KASIR POS</span>
                </div>
                <small class="text-muted fw-semibold" style="font-size: 0.75rem;">TRANSAKSI PENJUALAN SEMEN</small>
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
            <a href="{{ route('admin.products.index') }}" class="nav-pill-btn">
                <i class="fa-solid fa-boxes-stacked"></i> Halaman Produk
            </a>
            <a href="{{ route('cashier.index') }}" class="nav-pill-btn active">
                <i class="fa-solid fa-cash-register"></i> Kasir
            </a>
            <a href="{{ route('profile.index') }}" class="nav-pill-btn">
                <i class="fa-solid fa-users"></i> Daftar Pelanggan
            </a>
        </div>

        <!-- Tombol Keranjang Belanja -->
        <div class="d-flex align-items-center gap-2">
            <button class="btn btn-orange-cement rounded-pill px-3 py-1 fw-bold btn-sm position-relative" onclick="showCartDrawer()">
                <i class="fa-solid fa-cart-shopping me-1"></i> Keranjang
                <span id="cartBadgeCount" class="badge bg-white text-dark rounded-circle ms-1">0</span>
            </button>
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3 fw-semibold">
                    <i class="fa-solid fa-right-from-bracket me-1"></i> Logout
                </button>
            </form>
        </div>
    </header>

    <!-- Main Container Content POS Kasir -->
    <div class="container py-4 px-3" style="max-width: 1180px;">

        <!-- Header Judul & Search Bar -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            <div>
                <h3 class="fw-extrabold text-dark m-0">Katalog Semen</h3>
                <p class="text-muted small m-0 mt-1">Pilih produk semen untuk ditambahkan ke keranjang atau langsung checkout transaksi.</p>
            </div>

            <!-- Search Input POS -->
            <div class="input-group shadow-sm" style="max-width: 380px;">
                <span class="input-group-text bg-white border-end-0 text-muted"><i class="fa-solid fa-magnifying-glass"></i></span>
                <input type="text" id="searchPosInput" class="form-control border-start-0 bg-white" placeholder="Cari merk semen (Tiga Roda, Gresik, Padang)..." onkeyup="filterPosProducts()">
            </div>
        </div>

        <!-- Grid Katalog Produk Semen -->
        <div class="row g-4" id="posProductGrid">

            <!-- Card Produk 1 -->
            <div class="col-md-3 pos-item">
                <div class="product-card-pos p-3">
                    <div>
                        <div class="product-img-box rounded-4 mb-3">
                            <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill badge-status-pos fw-bold">Aktif</span>
                            <i class="fa-solid fa-cubes-stacked text-warning"></i>
                        </div>
                        <h6 class="fw-bold text-dark mb-1 product-title">Semen Kupang 40 kg</h6>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <strong class="text-dark fs-5 fw-extrabold">Rp 65.000</strong>
                            <small class="text-muted fw-semibold">Stok: 50 Sak</small>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-outline-secondary w-100 rounded-pill mb-2 fw-semibold btn-sm" onclick="addToCart('Semen Kupang 40 kg', 65000)">
                            <i class="fa-solid fa-cart-plus me-1"></i> + Keranjang
                        </button>
                        <button class="btn btn-orange-cement w-100 rounded-pill fw-bold btn-sm" onclick="directCheckout('Semen Kupang 40 kg', 65000)">
                            <i class="fa-solid fa-bolt me-1"></i> Beli Sekarang
                        </button>
                    </div>
                </div>
            </div>

            <!-- Card Produk 2 -->
            <div class="col-md-3 pos-item">
                <div class="product-card-pos p-3">
                    <div>
                        <div class="product-img-box rounded-4 mb-3">
                            <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill badge-status-pos fw-bold">Aktif</span>
                            <i class="fa-solid fa-cubes-stacked text-warning"></i>
                        </div>
                        <h6 class="fw-bold text-dark mb-1 product-title">Semen Tiga Roda 50kg</h6>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <strong class="text-dark fs-5 fw-extrabold">Rp 84.971</strong>
                            <small class="text-muted fw-semibold">Stok: 50 Sak</small>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-outline-secondary w-100 rounded-pill mb-2 fw-semibold btn-sm" onclick="addToCart('Semen Tiga Roda 50kg', 84971)">
                            <i class="fa-solid fa-cart-plus me-1"></i> + Keranjang
                        </button>
                        <button class="btn btn-orange-cement w-100 rounded-pill fw-bold btn-sm" onclick="directCheckout('Semen Tiga Roda 50kg', 84971)">
                            <i class="fa-solid fa-bolt me-1"></i> Beli Sekarang
                        </button>
                    </div>
                </div>
            </div>

            <!-- Card Produk 3 -->
            <div class="col-md-3 pos-item">
                <div class="product-card-pos p-3">
                    <div>
                        <div class="product-img-box rounded-4 mb-3">
                            <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill badge-status-pos fw-bold">Aktif</span>
                            <i class="fa-solid fa-cubes-stacked text-warning"></i>
                        </div>
                        <h6 class="fw-bold text-dark mb-1 product-title">Dynamix 50 kg</h6>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <strong class="text-dark fs-5 fw-extrabold">Rp 65.000</strong>
                            <small class="text-danger fw-semibold">Stok: 18 Sak</small>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-outline-secondary w-100 rounded-pill mb-2 fw-semibold btn-sm" onclick="addToCart('Dynamix 50 kg', 65000)">
                            <i class="fa-solid fa-cart-plus me-1"></i> + Keranjang
                        </button>
                        <button class="btn btn-orange-cement w-100 rounded-pill fw-bold btn-sm" onclick="directCheckout('Dynamix 50 kg', 65000)">
                            <i class="fa-solid fa-bolt me-1"></i> Beli Sekarang
                        </button>
                    </div>
                </div>
            </div>

            <!-- Card Produk 4 -->
            <div class="col-md-3 pos-item">
                <div class="product-card-pos p-3">
                    <div>
                        <div class="product-img-box rounded-4 mb-3">
                            <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill badge-status-pos fw-bold">Aktif</span>
                            <i class="fa-solid fa-cubes-stacked text-warning"></i>
                        </div>
                        <h6 class="fw-bold text-dark mb-1 product-title">Semen Padang 40 kg</h6>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <strong class="text-dark fs-5 fw-extrabold">Rp 55.000</strong>
                            <small class="text-muted fw-semibold">Stok: 50 Sak</small>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-outline-secondary w-100 rounded-pill mb-2 fw-semibold btn-sm" onclick="addToCart('Semen Padang 40 kg', 55000)">
                            <i class="fa-solid fa-cart-plus me-1"></i> + Keranjang
                        </button>
                        <button class="btn btn-orange-cement w-100 rounded-pill fw-bold btn-sm" onclick="directCheckout('Semen Padang 40 kg', 55000)">
                            <i class="fa-solid fa-bolt me-1"></i> Beli Sekarang
                        </button>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!-- DRAWER KERANJANG BELANJA -->
    <div id="cartDrawerBackdrop" class="cart-drawer-backdrop">
        <div class="cart-drawer-box">
            <!-- Header Keranjang -->
            <div class="p-4 text-white d-flex align-items-center justify-content-between" style="background: linear-gradient(135deg, #1e293b, #334155);">
                <div class="d-flex align-items-center gap-2">
                    <i class="fa-solid fa-cart-shopping fs-5 text-warning"></i>
                    <h5 class="fw-bold m-0">Keranjang Kasir</h5>
                </div>
                <button type="button" class="btn-close btn-close-white" onclick="hideCartDrawer()"></button>
            </div>

            <!-- List Item Keranjang Belanja -->
            <div class="p-4 flex-grow-1 overflow-auto" id="cartItemList">
                <div class="text-center text-muted py-5" id="emptyCartNotice">
                    <i class="fa-solid fa-basket-shopping fs-1 mb-2 text-secondary opacity-50"></i>
                    <p class="m-0 small">Keranjang masih kosong.<br>Pilih produk semen untuk ditambahkan.</p>
                </div>
            </div>

            <!-- Footer Total & Checkout -->
            <div class="p-4 border-top bg-light">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted fw-semibold">Total Pembayaran:</span>
                    <strong class="text-dark fs-4 fw-extrabold" id="cartTotalPrice">Rp 0</strong>
                </div>
                <button class="btn btn-orange-cement w-100 rounded-pill py-2 fw-bold fs-6" onclick="processCheckout()">
                    <i class="fa-solid fa-cash-register me-1"></i> Proses Checkout Transaksi
                </button>
            </div>
        </div>
    </div>

    <!-- MODAL POPUP NOTA PEMBELIAN INTERAKTIF -->
    <div id="receiptModalBackdrop" class="receipt-modal-backdrop">
        <div class="receipt-card">
            <div class="p-4 text-center text-white" style="background: linear-gradient(135deg, #1e293b, #334155);">
                <div class="bg-success text-white rounded-circle mx-auto d-flex align-items-center justify-content-center mb-2" style="width: 50px; height: 50px;">
                    <i class="fa-solid fa-check fs-4"></i>
                </div>
                <h5 class="fw-bold m-0">Transaksi Lunas & Sukses!</h5>
                <small class="text-light opacity-75">Toko Semen Jaya - Nota Pembelian Resmi</small>
            </div>

            <div class="p-4">
                <div class="d-flex justify-content-between align-items-center mb-2 small text-muted">
                    <span>No. Transaksi: <strong class="text-dark" id="receiptTrxNo">#TRX-9981</strong></span>
                    <span id="receiptDate">2026-10-20</span>
                </div>
                <hr class="my-2">

                <!-- List Produk Nota -->
                <div id="receiptDetailList" class="mb-3"></div>

                <div class="bg-light p-3 rounded-3 border d-flex justify-content-between align-items-center">
                    <span class="fw-bold text-dark">Total Pembayaran:</span>
                    <strong class="text-success fs-5 fw-extrabold" id="receiptTotalPay">Rp 0</strong>
                </div>
            </div>

            <div class="p-3 bg-light border-top text-center">
                <button class="btn btn-orange-cement rounded-pill px-4 fw-bold w-100" onclick="closeReceiptModal()">
                    <i class="fa-solid fa-print me-1"></i> Cetak Nota / Selesai
                </button>
            </div>
        </div>
    </div>

    <!-- Pustaka JS Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/bootstrap.bundle.min.js"></script>

    <!-- JavaScript Interaktif POS Kasir -->
    <script>
        let cartItems = [];

        function showCartDrawer() {
            document.getElementById('cartDrawerBackdrop').classList.add('show');
        }

        function hideCartDrawer() {
            document.getElementById('cartDrawerBackdrop').classList.remove('show');
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

        function addToCart(name, price) {
            const existingItem = cartItems.find(item => item.name === name);
            if (existingItem) {
                existingItem.qty += 1;
            } else {
                cartItems.push({ name: name, price: price, qty: 1 });
            }
            renderCart();
            showCartDrawer();
        }

        function directCheckout(name, price) {
            addToCart(name, price);
        }

        function removeFromCart(index) {
            cartItems.splice(index, 1);
            renderCart();
        }

        function renderCart() {
            const container = document.getElementById('cartItemList');
            const badgeCount = document.getElementById('cartBadgeCount');
            const totalPriceEl = document.getElementById('cartTotalPrice');

            if (cartItems.length === 0) {
                container.innerHTML = `
                    <div class="text-center text-muted py-5" id="emptyCartNotice">
                        <i class="fa-solid fa-basket-shopping fs-1 mb-2 text-secondary opacity-50"></i>
                        <p class="m-0 small">Keranjang masih kosong.<br>Pilih produk semen untuk ditambahkan.</p>
                    </div>
                `;
                badgeCount.innerText = '0';
                totalPriceEl.innerText = 'Rp 0';
                return;
            }

            let html = '';
            let total = 0;
            let totalQty = 0;

            cartItems.forEach((item, index) => {
                const subtotal = item.price * item.qty;
                total += subtotal;
                totalQty += item.qty;

                html += `
                    <div class="bg-light p-3 rounded-3 border mb-3 d-flex justify-content-between align-items-center">
                        <div>
                            <strong class="text-dark d-block style="font-size: 0.875rem;">${item.name}</strong>
                            <small class="text-muted">${item.qty} Sak x Rp ${item.price.toLocaleString('id-ID')}</small>
                        </div>
                        <div class="text-end">
                            <strong class="text-dark d-block mb-1">Rp ${subtotal.toLocaleString('id-ID')}</strong>
                            <button class="btn btn-sm btn-outline-danger border-0 p-0" onclick="removeFromCart(${index})">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </div>
                    </div>
                `;
            });

            container.innerHTML = html;
            badgeCount.innerText = totalQty;
            totalPriceEl.innerText = 'Rp ' + total.toLocaleString('id-ID');
        }

        function processCheckout() {
            if (cartItems.length === 0) {
                return;
            }

            // Generate Rincian Nota
            const randomTrx = Math.floor(1000 + Math.random() * 9000);
            document.getElementById('receiptTrxNo').innerText = '#TRX-' + randomTrx;

            let detailHtml = '';
            let grandTotal = 0;

            cartItems.forEach(item => {
                const sub = item.price * item.qty;
                grandTotal += sub;
                detailHtml += `
                    <div class="d-flex justify-content-between align-items-center mb-2 small">
                        <span><strong>${item.name}</strong> (${item.qty} Sak)</span>
                        <strong class="text-dark">Rp ${sub.toLocaleString('id-ID')}</strong>
                    </div>
                `;
            });

            document.getElementById('receiptDetailList').innerHTML = detailHtml;
            document.getElementById('receiptTotalPay').innerText = 'Rp ' + grandTotal.toLocaleString('id-ID');

            // Tampilkan Modal Nota Struk Sukses
            document.getElementById('receiptModalBackdrop').classList.add('show');
        }

        function closeReceiptModal() {
            // Selesaikan Transaksi & Bersihkan Keranjang
            document.getElementById('receiptModalBackdrop').classList.remove('show');
            cartItems = [];
            renderCart();
            hideCartDrawer();
        }

        function filterPosProducts() {
            const input = document.getElementById('searchPosInput').value.toLowerCase();
            const items = document.querySelectorAll('.pos-item');

            items.forEach(item => {
                const title = item.querySelector('.product-title').innerText.toLowerCase();
                if (title.includes(input)) {
                    item.style.display = "";
                } else {
                    item.style.display = "none";
                }
            });
        }
    </script>
</body>
</html>