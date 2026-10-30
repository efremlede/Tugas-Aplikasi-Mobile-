<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Baru - Toko Semen Jaya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-red: #8B1E21;
            --primary-red-hover: #6F171A;
            --sidebar-width: 240px;
        }

        body {
            background-color: #f4f5f7;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Sidebar Navigation */
        .sidebar {
            width: var(--sidebar-width);
            background-color: var(--primary-red);
            min-height: 100vh;
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
        }

        .sidebar .brand {
            padding: 20px 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar .menu-label {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.5);
            padding: 15px 20px 5px;
            text-transform: uppercase;
            font-weight: 600;
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 12px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
        }

        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            color: #fff;
            background-color: rgba(0, 0, 0, 0.2);
            border-left: 4px solid #fff;
        }

        /* Main Content Layout */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 20px 30px;
        }

        .top-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: var(--primary-red);
            color: #fff;
            padding: 10px 20px;
            margin: -20px -30px 20px -30px;
        }

        .card-custom {
            border: none;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
            background-color: #fff;
        }

        .btn-red {
            background-color: var(--primary-red);
            color: #fff;
            border: none;
        }

        .btn-red:hover {
            background-color: var(--primary-red-hover);
            color: #fff;
        }

        .payment-btn {
            border: 1px solid #dee2e6;
            background-color: #f8f9fa;
            color: #333;
        }

        .payment-btn.active {
            background-color: var(--primary-red);
            color: #fff;
            border-color: var(--primary-red);
        }

        /* Modal Customization */
        .modal-success-icon {
            width: 60px;
            height: 60px;
            background-color: #FDF2F2;
            color: var(--primary-red);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin: 0 auto 15px;
        }
    </style>
</head>
<body>

    <!-- Sidebar Menus -->
    <div class="sidebar">
        <div class="brand">
            <h5 class="fw-bold m-0"><i class="fa-solid fa-store me-2"></i>Toko Semen Jaya</h5>
            <small class="text-white-50">Sistem Informasi Kasir</small>
        </div>

        <div class="menu-label">Menu Kasir</div>
        <a href="{{ route('cashier.index') }}" class="nav-link active">
            <i class="fa-solid fa-cart-shopping"></i> Transaksi Baru
        </a>
        <a href="{{ route('cashier.pelanggan') }}" class="nav-link">
            <i class="fa-solid fa-id-card"></i> Member NFC
        </a>
        <a href="{{ route('admin.products.index') }}" class="nav-link">
            <i class="fa-solid fa-boxes-stacked"></i> Daftar Produk
        </a>
        <a href="{{ route('cashier.riwayat') }}" class="nav-link">
            <i class="fa-solid fa-clock-rotate-left"></i> Riwayat Transaksi
        </a>
        <a href="#" class="nav-link">
            <i class="fa-solid fa-chart-line"></i> Laporan
        </a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Navbar -->
        <div class="top-header">
            <div><strong>Toko Semen Jaya</strong></div>
            <div class="d-flex align-items-center gap-3">
                <span class="badge bg-light text-dark"><i class="fa-solid fa-user me-1"></i> {{ auth()->user()->name ?? 'Kasir 1' }}</span>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm">
                        <i class="fa-solid fa-right-from-bracket me-1"></i> Keluar
                    </button>
                </form>
            </div>
        </div>

        <!-- Header Title -->
        <div class="d-flex justify-content-between align-items-start mb-3">
            <div>
                <h4 class="fw-bold m-0">Transaksi Baru</h4>
                <small class="text-muted">Masukkan barang ke keranjang, lalu lanjutkan pembayaran.</small>
            </div>
            <div class="text-end">
                <small class="text-muted d-block">No. Transaksi</small>
                <strong id="trx-no">TRX-{{ date('Ymd') }}-{{ rand(100, 999) }}</strong><br>
                <small class="text-muted">{{ date('d/m/Y, H:i') }} WIB</small>
            </div>
        </div>

        <div class="row g-3">
            <!-- Left Area: Search & Cart Table -->
            <div class="col-lg-8">
                <div class="card card-custom p-3 mb-3">
                    <label class="form-label fw-semibold">Tambah Barang</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-magnifying-glass"></i></span>
                        <input type="text" id="search_product" class="form-control border-start-0" placeholder="Cari nama barang / kategori / scan barcode..." autofocus>
                        <button class="btn btn-red px-4" type="button" id="btn-search">Cari Barang</button>
                    </div>
                </div>

                <div class="card card-custom p-3">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold m-0">Keranjang Belanja</h6>
                        <span class="badge bg-light text-dark border" id="item-count">0 Item</span>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 50px;">NO</th>
                                    <th>BARANG</th>
                                    <th class="text-end">HARGA</th>
                                    <th class="text-center" style="width: 100px;">QTY</th>
                                    <th class="text-end">SUBTOTAL</th>
                                    <th class="text-center" style="width: 50px;"></th>
                                </tr>
                            </thead>
                            <tbody id="cart-table-body">
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        Keranjang belanja masih kosong.<br>Silakan cari barang di atas.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Right Area: Payment Summary -->
            <div class="col-lg-4">
                <div class="card card-custom p-3">
                    <h6 class="fw-bold mb-3">Ringkasan Pembayaran</h6>

                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Total Item</span>
                        <strong id="summary-items">0</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Subtotal</span>
                        <strong id="summary-subtotal">Rp 0</strong>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Biaya Lain</span>
                        <input type="number" class="form-control form-control-sm text-end" style="width: 90px;" value="0">
                    </div>

                    <div class="p-3 bg-light rounded mb-3">
                        <small class="text-muted d-block fw-semibold">TOTAL AKHIR</small>
                        <h2 class="fw-bold text-danger m-0" id="summary-grand-total">Rp 0</h2>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted small fw-semibold">Pelanggan</label>
                        <select class="form-select form-select-sm">
                            <option selected>Pelanggan umum</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted small fw-semibold">Uang Dibayar</label>
                        <input type="number" id="pay-amount" class="form-control form-control-lg text-end fw-bold" placeholder="0">
                    </div>

                    <label class="form-label text-muted small fw-semibold">Metode Pembayaran</label>
                    <div class="row g-2 mb-3">
                        <div class="col-6"><button class="btn payment-btn w-100 btn-sm active" data-method="tunai">Tunai</button></div>
                        <div class="col-6"><button class="btn payment-btn w-100 btn-sm" data-method="qris">QRIS</button></div>
                        <div class="col-6"><button class="btn payment-btn w-100 btn-sm" data-method="transfer">Transfer</button></div>
                        <div class="col-6"><button class="btn payment-btn w-100 btn-sm" data-method="nfc">Tap NFC</button></div>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block fw-semibold">KEMBALIAN</small>
                        <h4 class="fw-bold text-success m-0" id="summary-change">Rp 0</h4>
                    </div>

                    <div class="row g-2 mb-2">
                        <div class="col-6"><button class="btn btn-warning w-100 fw-bold text-dark">Tahan</button></div>
                        <div class="col-6"><button class="btn btn-danger w-100 fw-bold" onclick="resetCart()">Batal</button></div>
                    </div>

                    <button class="btn btn-success btn-lg w-100 fw-bold" id="btn-pay">BAYAR & CETAK</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Pop-up "Pembayaran Berhasil" (Sesuai Contoh Gambar) -->
    <div class="modal fade" id="paymentSuccessModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 420px;">
            <div class="modal-content border-0 shadow-lg rounded-4 p-3">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center pt-0">
                    <div class="modal-success-icon">
                        <i class="fa-solid fa-receipt"></i>
                    </div>

                    <h4 class="fw-bold mb-2">Pembayaran Berhasil</h4>
                    <p class="text-muted small mb-4">Transaksi sudah tersimpan. Apakah Anda ingin mencetak struk untuk pelanggan?</p>

                    <div class="bg-light p-3 rounded-3 text-start mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted small">No. Invoice</span>
                            <strong class="small" id="modal-invoice">INV-{{ date('Ymd') }}-001</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="fw-bold">Total belanja</span>
                            <strong class="fw-bold text-danger" id="modal-total">Rp 0</strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted small">Kembalian</span>
                            <strong class="small" id="modal-change">Rp 0</strong>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-danger w-50 py-2 fw-semibold" data-bs-dismiss="modal">
                            Selesai Tanpa Cetak
                        </button>
                        <button type="button" class="btn btn-red w-50 py-2 fw-semibold" id="btn-print-receipt">
                            <i class="fa-solid fa-print me-1"></i> Cetak Struk
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let cart = [];
        let currentSaleId = 1;

        // Simulasi Tambah Produk ke Keranjang saat Enter di Input Pencarian
        $('#search_product').on('keypress', function(e) {
            if (e.which === 13) {
                e.preventDefault();
                let name = $(this).val().trim();
                if (name === '') name = 'Semen Tiga Roda 50kg';

                cart.push({
                    id: cart.length + 1,
                    name: name,
                    category: 'Semen',
                    price: 65000,
                    qty: 1
                });

                $(this).val('');
                renderCart();
            }
        });

        function renderCart() {
            let html = '';
            let subtotal = 0;

            cart.forEach((item, index) => {
                let itemSubtotal = item.price * item.qty;
                subtotal += itemSubtotal;

                html += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>
                            <strong class="d-block">${item.name}</strong>
                            <small class="text-muted">${item.category}</small>
                        </td>
                        <td class="text-end">Rp ${item.price.toLocaleString('id-ID')}</td>
                        <td class="text-center">
                            <input type="number" class="form-control form-control-sm text-center" value="${item.qty}" min="1" onchange="updateQty(${index}, this.value)">
                        </td>
                        <td class="text-end fw-bold">Rp ${itemSubtotal.toLocaleString('id-ID')}</td>
                        <td class="text-center">
                            <button class="btn btn-sm text-danger" onclick="removeItem(${index})"><i class="fa-solid fa-xmark fs-5"></i></button>
                        </td>
                    </tr>
                `;
            });

            if (cart.length === 0) {
                html = `<tr><td colspan="6" class="text-center py-5 text-muted">Keranjang belanja masih kosong.<br>Silakan cari barang di atas.</td></tr>`;
            }

            $('#cart-table-body').html(html);
            $('#item-count').text(cart.length + ' Item');
            $('#summary-items').text(cart.length);

            calculateTotal(subtotal);
        }

        function updateQty(index, val) {
            cart[index].qty = Math.max(1, parseInt(val) || 1);
            renderCart();
        }

        function removeItem(index) {
            cart.splice(index, 1);
            renderCart();
        }

        function resetCart() {
            cart = [];
            $('#pay-amount').val('');
            renderCart();
        }

        function calculateTotal(subtotalParam) {
            let subtotal = subtotalParam !== undefined ? subtotalParam : cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
            let payAmount = parseFloat($('#pay-amount').val()) || 0;
            let change = Math.max(0, payAmount - subtotal);

            $('#summary-subtotal').text('Rp ' + subtotal.toLocaleString('id-ID'));
            $('#summary-grand-total').text('Rp ' + subtotal.toLocaleString('id-ID'));
            $('#summary-change').text('Rp ' + change.toLocaleString('id-ID'));

            return { subtotal, payAmount, change };
        }

        $('#pay-amount').on('input', function() {
            calculateTotal();
        });

        // Klik Tombol BAYAR & CETAK -> Tampilkan Modal Pop-up
        $('#btn-pay').on('click', function() {
            if (cart.length === 0) {
                alert('Keranjang belanja masih kosong!');
                return;
            }

            let calc = calculateTotal();
            if (calc.payAmount < calc.subtotal) {
                alert('Uang pembayaran masih kurang!');
                return;
            }

            // Set data ke modal
            $('#modal-invoice').text('INV-' + new Date().toISOString().slice(0,10).replace(/-/g,'') + '-' + Math.floor(1000 + Math.random() * 9000));
            $('#modal-total').text('Rp ' + calc.subtotal.toLocaleString('id-ID'));
            $('#modal-change').text('Rp ' + calc.change.toLocaleString('id-ID'));

            // Tampilkan Modal Bootstrap
            var successModal = new bootstrap.Modal(document.getElementById('paymentSuccessModal'));
            successModal.show();
        });

        // Action Tombol "Cetak Struk" pada Modal Pop-up
        $('#btn-print-receipt').on('click', function() {
            window.open('/kasir/riwayat/' + currentSaleId + '/struk', '_blank', 'width=400,height=600');
            $('#paymentSuccessModal').modal('hide');
            resetCart();
        });

        // Reset keranjang jika modal ditutup (Selesai Tanpa Cetak)
        $('#paymentSuccessModal').on('hidden.bs.modal', function () {
            resetCart();
        });
    </script>
</body>
</html>