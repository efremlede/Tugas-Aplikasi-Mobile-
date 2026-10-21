<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Kasir / POS</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
        }
        .search-results {
            position: absolute;
            z-index: 1000;
            width: 100%;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            max-height: 250px;
            overflow-y: auto;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .product-item {
            padding: 10px 15px;
            cursor: pointer;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .product-item:hover {
            background-color: #f8f9fa;
        }
        .product-name {
            font-weight: bold;
        }
        .product-code {
            font-size: 0.85rem;
            color: #6c757d;
        }
        .product-price {
            font-weight: bold;
            color: #0d6efd;
        }
        .short-payment {
            background-color: #f8d7da !important;
            color: #842029 !important;
        }
        .payment-method button.active {
            background-color: #0d6efd;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container-fluid py-3">
        <!-- Header -->
        <div class="row mb-3 align-items-center">
            <div class="col-md-6">
                <h3 class="m-0 font-weight-bold">Sistem Kasir (POS)</h3>
            </div>
            <div class="col-md-6 text-end">
                <span class="badge bg-secondary fs-6" id="currentDate">-</span>
            </div>
        </div>

        <div class="row">
            <!-- Kolom Kiri: Input & Tabel Keranjang -->
            <div class="col-lg-8 mb-3">
                <!-- Box Pencarian Barang -->
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="position-relative">
                            <label for="searchProduct" class="form-label font-weight-bold">Cari / Scan Barang (Tekan F2)</label>
                            <input type="text" id="searchProduct" class="form-control form-control-lg" placeholder="Masukkan Nama / Kode / Barcode Barang..." autocomplete="off">
                            <div id="productResults" class="search-results" style="display: none;"></div>
                        </div>
                    </div>
                </div>

                <!-- Tabel Keranjang Belanja -->
                <div class="card">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="m-0">Keranjang Belanja</h5>
                        <span class="badge bg-primary" id="itemCount">0 Item</span>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 50px;">#</th>
                                        <th>Barang</th>
                                        <th style="width: 120px;">Harga</th>
                                        <th style="width: 130px;">Qty</th>
                                        <th class="text-end" style="width: 130px;">Subtotal</th>
                                        <th class="text-center" style="width: 60px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="cartBody">
                                    <!-- Render Otomatis via JS -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Ringkasan & Pembayaran -->
            <div class="col-lg-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <!-- Total Grand -->
                        <div class="bg-dark text-white p-3 rounded mb-3 text-center">
                            <div class="small text-uppercase">TOTAL BAYAR</div>
                            <h1 class="display-5 font-weight-bold m-0" id="grandTotal">Rp 0</h1>
                        </div>

                        <!-- Form Penyesuaian Harga/Diskon -->
                        <div class="mb-2 row">
                            <label class="col-6 col-form-label">Subtotal:</label>
                            <div class="col-6 text-end col-form-label font-weight-bold" id="subtotal">Rp 0</div>
                        </div>
                        <div class="mb-2 row">
                            <label class="col-6 col-form-label">Diskon (%):</label>
                            <div class="col-6">
                                <input type="number" id="discountPercent" class="form-control form-control-sm text-end" value="0" min="0" max="100">
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <label class="col-6 col-form-label">Diskon Rp:</label>
                            <div class="col-6">
                                <input type="number" id="discountAmount" class="form-control form-control-sm text-end" value="0" min="0">
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <label class="col-6 col-form-label">Pajak / PPN:</label>
                            <div class="col-6">
                                <input type="number" id="tax" class="form-control form-control-sm text-end" value="0" min="0">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-6 col-form-label">Biaya Lain:</label>
                            <div class="col-6">
                                <input type="number" id="otherFee" class="form-control form-control-sm text-end" value="0" min="0">
                            </div>
                        </div>

                        <hr>

                        <!-- Input Pembayaran & Kembalian -->
                        <div class="mb-3">
                            <label for="payment" class="form-label font-weight-bold">Nominal Bayar (F4)</label>
                            <input type="number" id="payment" class="form-control form-control-lg text-end" placeholder="0">
                        </div>

                        <div id="changeBox" class="p-3 rounded bg-light mb-3 text-center border">
                            <div class="small text-uppercase font-weight-bold change-label">KEMBALIAN</div>
                            <h3 class="m-0 font-weight-bold" id="change">Rp 0</h3>
                        </div>

                        <!-- Metode Pembayaran -->
                        <div class="mb-3 payment-method d-flex gap-2">
                            <button type="button" class="btn btn-outline-primary w-100 active" onclick="selectPayment(this)">Tunai</button>
                            <button type="button" class="btn btn-outline-primary w-100" onclick="selectPayment(this)">QRIS</button>
                            <button type="button" class="btn btn-outline-primary w-100" onclick="selectPayment(this)">Debit</button>
                        </div>

                        <!-- Tombol Aksi Transaksi -->
                        <div class="d-grid gap-2">
                            <button type="button" class="btn btn-success btn-lg" onclick="processPayment()">Bayar Transaksi</button>
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-warning w-100" onclick="holdTransaction()">Tahan (Hold)</button>
                                <button type="button" class="btn btn-danger w-100" onclick="cancelTransaction()">Batal (ESC)</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Panggilan File JS Aplikasi Kasir -->
    <script src="{{ asset('js/chasier.js') }}"></script>
</body>
</html>