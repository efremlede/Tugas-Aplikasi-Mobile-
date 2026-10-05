<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Kasir / POS - Toko Semen Jaya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f4f6f9; font-family: "Segoe UI", Roboto, Arial, sans-serif; font-size: 0.9rem; }
        .top-navbar { background: #ffffff; border-bottom: 1px solid #e3e6f0; padding: 8px 15px; }
        .btn-hold { background-color: #ffc107; color: #fff; font-weight: bold; border: none; }
        .btn-hold-list { background-color: #6c757d; color: #fff; font-weight: bold; border: none; }
        .btn-cancel { background-color: #dc3545; color: #fff; font-weight: bold; border: none; }
        .card-custom { background: #ffffff; border: 1px solid #e3e6f0; border-radius: 6px; padding: 15px; }
        .table-pos th { background-color: #0d6efd; color: #ffffff; font-weight: 600; }
        .total-pay-box { background-color: #f8f9fa; border-radius: 6px; padding: 10px; text-align: center; }
        .total-pay-val { color: #0d6efd; font-weight: bold; font-size: 2rem; }
        .change-box { background-color: #d1e7dd; color: #0f5132; border-radius: 6px; padding: 12px 15px; font-weight: bold; }
        .btn-pay { background-color: #198754; color: #fff; font-weight: bold; font-size: 1.1rem; padding: 12px; border: none; width: 100%; border-radius: 6px; }
        .btn-pay:hover { background-color: #157347; }
        .search-results { position: absolute; z-index: 1000; width: 100%; background: white; border: 1px solid #ccc; max-height: 200px; overflow-y: auto; display: none; }
        .search-item { padding: 8px 12px; cursor: pointer; border-bottom: 1px solid #eee; }
        .search-item:hover { background-color: #0d6efd; color: white; }

        /* TAMPILAN STRUK THERMAL SUNGGUHAN (80mm) */
        #printableReceipt {
            display: none;
            width: 80mm;
            padding: 10px;
            font-family: "Courier New", Courier, monospace;
            font-size: 11px;
            color: #000;
        }
        .receipt-header, .receipt-footer { text-align: center; }
        .receipt-line { border-bottom: 1px dashed #000; margin: 5px 0; }
        .receipt-table { width: 100%; border-collapse: collapse; }
        .receipt-table td { vertical-align: top; }
        .receipt-table td.num { text-align: right; }

        /* KHUSUS UNTUK PRINTER (CSS PRINT) */
        @media print {
            body * { visibility: hidden !important; }
            #printableReceipt, #printableReceipt * { visibility: visible !important; }
            #printableReceipt { display: block !important; position: absolute; left: 0; top: 0; width: 100%; }
        }
    </style>
</head>
<body>

    <!-- Header Navbar -->
    <div class="top-navbar d-flex justify-content-between align-items-center">
        <h5 class="mb-0 text-primary fw-bold">Sistem Kasir (POS) - Semen Jaya</h5>
        <div class="d-flex align-items-center gap-2">
            <span class="text-muted fw-semibold me-2" id="liveClock">3/10/2026, 20.42.20</span>
            <button class="btn btn-hold btn-sm px-3" onclick="holdCart()">Tahan (Hold)</button>
            <button class="btn btn-hold-list btn-sm px-3" onclick="showHoldList()">Daftar Hold (<span id="holdCount">0</span>)</button>
            <button class="btn btn-cancel btn-sm px-3" onclick="clearCart()">Batal (Esc)</button>
        </div>
    </div>

    <div class="container-fluid p-3">
        <div class="row g-3">
            
            <!-- Kolom Kiri: Cari Produk & Keranjang -->
            <div class="col-lg-7">
                <div class="card-custom shadow-sm mb-3">
                    <label class="form-label fw-bold mb-1">Cari / Scan Barcode (F2)</label>
                    <div class="position-relative">
                        <input type="text" id="barcodeInput" class="form-control" placeholder="Ketik nama atau scan barcode barang..." oninput="onSearchInput()">
                        <div id="searchResults" class="search-results shadow-sm"></div>
                    </div>
                </div>

                <div class="card-custom shadow-sm p-0 overflow-hidden">
                    <div class="table-responsive" style="min-height: 380px;">
                        <table class="table table-bordered table-pos align-middle mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">#</th>
                                    <th style="width: 40%;">Produk</th>
                                    <th style="width: 20%;">Harga</th>
                                    <th style="width: 15%;">Qty</th>
                                    <th style="width: 20%;">Subtotal</th>
                                    <th style="width: 5%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="cartTableBody">
                                <tr id="emptyRow">
                                    <td colspan="6" class="text-center text-muted py-5">
                                        Keranjang masih kosong.<br>Silakan cari atau scan barcode barang.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Rincian Pembayaran -->
            <div class="col-lg-5">
                <div class="card-custom shadow-sm">
                    <!-- Pelanggan -->
                    <div class="row align-items-center mb-2">
                        <label class="col-sm-4 col-form-label fw-bold">Pelanggan:</label>
                        <div class="col-sm-8">
                            <select class="form-select form-select-sm" id="customerSelect">
                                <option value="Umum">-- Umum --</option>
                                <option value="Member Setia">Member Setia</option>
                            </select>
                        </div>
                    </div>

                    <!-- Total Qty & Subtotal -->
                    <div class="d-flex justify-content-between my-1">
                        <span class="text-muted">Total Qty:</span>
                        <span class="fw-bold" id="totalQtyVal">0</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Subtotal:</span>
                        <span class="fw-bold fs-6" id="subtotalVal">Rp 0</span>
                    </div>

                    <!-- Diskon & Pajak/Biaya -->
                    <div class="row g-2 mb-2">
                        <div class="col-6">
                            <label class="form-label small mb-1">Diskon (%)</label>
                            <input type="number" id="discountPercent" class="form-control form-control-sm" value="0" oninput="calculateTotals()">
                        </div>
                        <div class="col-6">
                            <label class="form-label small mb-1">Diskon (Rp)</label>
                            <input type="number" id="discountRp" class="form-control form-control-sm" value="0" oninput="calculateTotals()">
                        </div>
                        <div class="col-6">
                            <label class="form-label small mb-1">Pajak (Rp)</label>
                            <input type="number" id="taxRp" class="form-control form-control-sm" value="0" oninput="calculateTotals()">
                        </div>
                        <div class="col-6">
                            <label class="form-label small mb-1">Biaya Lain (Rp)</label>
                            <input type="number" id="otherFeeRp" class="form-control form-control-sm" value="0" oninput="calculateTotals()">
                        </div>
                    </div>

                    <!-- Box Total Bayar -->
                    <div class="total-pay-box my-3">
                        <div class="small text-muted fw-bold">TOTAL BAYAR</div>
                        <div class="total-pay-val" id="grandTotalDisplay">Rp 0</div>
                    </div>

                    <!-- Metode Pembayaran -->
                    <label class="form-label fw-bold mb-1">Metode Pembayaran</label>
                    <div class="btn-group w-100 mb-3" role="group">
                        <input type="radio" class="btn-check" name="payMethod" id="methodTunai" value="Tunai" checked>
                        <label class="btn btn-outline-primary" for="methodTunai">Tunai</label>

                        <input type="radio" class="btn-check" name="payMethod" id="methodQRIS" value="QRIS">
                        <label class="btn btn-outline-primary" for="methodQRIS">QRIS</label>

                        <input type="radio" class="btn-check" name="payMethod" id="methodTransfer" value="Transfer">
                        <label class="btn btn-outline-primary" for="methodTransfer">Transfer</label>
                    </div>

                    <!-- Jumlah Uang / Bayar -->
                    <label class="form-label fw-bold mb-1">Jumlah Uang / Bayar (F4)</label>
                    <input type="number" id="cashInput" class="form-control form-control-lg fw-bold mb-2" placeholder="0" oninput="calculateChange()">

                    <!-- Quick Cash Buttons -->
                    <div class="row g-2 mb-3">
                        <div class="col-4"><button class="btn btn-outline-secondary btn-sm w-100" onclick="setQuickCash('exact')">Uang Pas</button></div>
                        <div class="col-4"><button class="btn btn-outline-secondary btn-sm w-100" onclick="setQuickCash(50000)">50.000</button></div>
                        <div class="col-4"><button class="btn btn-outline-secondary btn-sm w-100" onclick="setQuickCash(100000)">100.000</button></div>
                    </div>

                    <!-- Kembalian -->
                    <div class="change-box d-flex justify-content-between align-items-center mb-3">
                        <span>KEMBALIAN</span>
                        <span class="fs-4" id="changeVal">Rp 0</span>
                    </div>

                    <!-- Tombol Bayar -->
                    <button class="btn-pay" onclick="processPayment()">
                        BAYAR & CETAK
                    </button>
                </div>
            </div>

        </div>
    </div>

    <!-- MODAL POPUP PREVIEW STRUK -->
    <div class="modal fade" id="receiptModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header py-2 bg-success text-white">
                    <h6 class="modal-title fw-bold"><i class="fa-solid fa-circle-check me-2"></i>Pembayaran Berhasil!</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" onclick="clearCart()"></button>
                </div>
                <div class="modal-body p-3 bg-light">
                    <!-- Tampilan Struk Modal -->
                    <div id="modalReceiptContent" class="bg-white p-3 shadow-sm border rounded"></div>
                </div>
                <div class="modal-footer py-2">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" onclick="clearCart()">Selesai</button>
                    <button type="button" class="btn btn-primary btn-sm fw-bold" onclick="triggerPrint()"><i class="fa-solid fa-print me-1"></i> Cetak Struk</button>
                </div>
            </div>
        </div>
    </div>

    <!-- WADAH KHUSUS CETAK PRINTER -->
    <div id="printableReceipt"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const productsDatabase = [
            { id: 1, name: "Semen Gresik 50kg", price: 65000, barcode: "888001" },
            { id: 2, name: "Semen Tiga Roda 50kg", price: 67000, barcode: "888002" },
            { id: 3, name: "Semen Padang 40kg", price: 54000, barcode: "888003" },
            { id: 4, name: "Semen Dinamix 50kg", price: 63000, barcode: "888004" },
            { id: 5, name: "Semen Putih Mekah 40kg", price: 95000, barcode: "888005" }
        ];

        let cart = [];
        let holdList = [];
        let grandTotal = 0;
        let lastSubtotal = 0;
        let lastDiscount = 0;

        function updateClock() {
            const now = new Date();
            document.getElementById("liveClock").innerText = now.toLocaleString("id-ID");
        }
        setInterval(updateClock, 1000);
        updateClock();

        function onSearchInput() {
            const query = document.getElementById("barcodeInput").value.toLowerCase().trim();
            const resultsDiv = document.getElementById("searchResults");
            if (!query) {
                resultsDiv.style.display = "none";
                return;
            }

            const matches = productsDatabase.filter(p => 
                p.name.toLowerCase().includes(query) || p.barcode.includes(query)
            );

            if (matches.length > 0) {
                let html = "";
                matches.forEach(p => {
                    html += `<div class="search-item" onclick="selectProduct(${p.id})">
                                <strong>${p.name}</strong> - Rp ${p.price.toLocaleString("id-ID")}
                             </div>`;
                });
                resultsDiv.innerHTML = html;
                resultsDiv.style.display = "block";
            } else {
                resultsDiv.style.display = "none";
            }
        }

        function selectProduct(id) {
            const p = productsDatabase.find(item => item.id === id);
            if (p) addToCart(p);
            document.getElementById("barcodeInput").value = "";
            document.getElementById("searchResults").style.display = "none";
        }

        function addToCart(product) {
            const existing = cart.find(i => i.id === product.id);
            if (existing) existing.qty++;
            else cart.push({ ...product, qty: 1 });
            renderCart();
        }

        function updateQty(id, qty) {
            const item = cart.find(i => i.id === id);
            if (item) item.qty = parseInt(qty) || 1;
            renderCart();
        }

        function removeFromCart(id) {
            cart = cart.filter(i => i.id !== id);
            renderCart();
        }

        function clearCart() {
            cart = [];
            document.getElementById("cashInput").value = "";
            renderCart();
        }

        function renderCart() {
            const tbody = document.getElementById("cartTableBody");
            if (cart.length === 0) {
                tbody.innerHTML = `
                    <tr id="emptyRow">
                        <td colspan="6" class="text-center text-muted py-5">
                            Keranjang masih kosong.<br>Silakan cari atau scan barcode barang.
                        </td>
                    </tr>`;
            } else {
                let html = "";
                cart.forEach((item, index) => {
                    const subtotal = item.price * item.qty;
                    html += `
                        <tr>
                            <td>${index + 1}</td>
                            <td class="fw-bold">${item.name}</td>
                            <td>Rp ${item.price.toLocaleString("id-ID")}</td>
                            <td>
                                <input type="number" min="1" class="form-control form-control-sm text-center" value="${item.qty}" onchange="updateQty(${item.id}, this.value)">
                            </td>
                            <td class="fw-bold text-end">Rp ${subtotal.toLocaleString("id-ID")}</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-danger py-0 px-2" onclick="removeFromCart(${item.id})"><i class="fa-solid fa-times"></i></button>
                            </td>
                        </tr>`;
                });
                tbody.innerHTML = html;
            }
            calculateTotals();
        }

        function calculateTotals() {
            let totalQty = 0;
            let subtotal = 0;

            cart.forEach(item => {
                totalQty += item.qty;
                subtotal += item.price * item.qty;
            });

            const discountPct = parseFloat(document.getElementById("discountPercent").value) || 0;
            const discountRp = parseFloat(document.getElementById("discountRp").value) || 0;
            const tax = parseFloat(document.getElementById("taxRp").value) || 0;
            const otherFee = parseFloat(document.getElementById("otherFeeRp").value) || 0;

            let totalDiscount = (subtotal * (discountPct / 100)) + discountRp;
            grandTotal = (subtotal - totalDiscount) + tax + otherFee;
            if (grandTotal < 0) grandTotal = 0;

            lastSubtotal = subtotal;
            lastDiscount = totalDiscount;

            document.getElementById("totalQtyVal").innerText = totalQty;
            document.getElementById("subtotalVal").innerText = "Rp " + subtotal.toLocaleString("id-ID");
            document.getElementById("grandTotalDisplay").innerText = "Rp " + grandTotal.toLocaleString("id-ID");

            calculateChange();
        }

        function setQuickCash(amount) {
            if (amount === "exact") document.getElementById("cashInput").value = grandTotal;
            else document.getElementById("cashInput").value = amount;
            calculateChange();
        }

        function calculateChange() {
            const cash = parseFloat(document.getElementById("cashInput").value) || 0;
            const change = cash - grandTotal;
            const changeEl = document.getElementById("changeVal");

            if (change >= 0 && grandTotal > 0) {
                changeEl.innerText = "Rp " + change.toLocaleString("id-ID");
            } else {
                changeEl.innerText = "Rp 0";
            }
        }

        function holdCart() {
            if (cart.length === 0) { alert("Keranjang kosong!"); return; }
            holdList.push([...cart]);
            document.getElementById("holdCount").innerText = holdList.length;
            clearCart();
            alert("Transaksi berhasil ditahan!");
        }

        function showHoldList() {
            if (holdList.length === 0) { alert("Tidak ada transaksi yang ditahan."); return; }
            cart = holdList.pop();
            document.getElementById("holdCount").innerText = holdList.length;
            renderCart();
        }

        // PROSES PEMBAYARAN DAN CETAK STRUK SUNGGUHAN
        function processPayment() {
            if (cart.length === 0) {
                alert("Keranjang belanja masih kosong!");
                return;
            }
            const cash = parseFloat(document.getElementById("cashInput").value) || 0;
            if (cash < grandTotal) {
                alert("Jumlah uang pembayaran kurang!");
                return;
            }

            const change = cash - grandTotal;
            const customer = document.getElementById("customerSelect").value;
            const payMethod = document.querySelector('input[name="payMethod"]:checked').value;
            const trxId = "TRX-" + Math.floor(100000 + Math.random() * 900000);
            const dateStr = new Date().toLocaleString("id-ID");

            let receiptHTML = `
                <div class="receipt-header">
                    <strong style="font-size: 13px;">TOKO SEMEN JAYA</strong><br>
                    Jl. Raya Utama No. 123, Jawa Timur<br>
                    Telp: 0812-3456-7890
                </div>
                <div class="receipt-line"></div>
                <div>
                    No  : ${trxId}<br>
                    Tgl : ${dateStr}<br>
                    Plg : ${customer}<br>
                    Ksr : {{ Auth::user()->name ?? "Kasir" }}
                </div>
                <div class="receipt-line"></div>
                <table class="receipt-table">
            `;

            cart.forEach(item => {
                const sub = item.price * item.qty;
                receiptHTML += `
                    <tr>
                        <td colspan="2"><strong>${item.name}</strong></td>
                    </tr>
                    <tr>
                        <td>${item.qty} x ${item.price.toLocaleString("id-ID")}</td>
                        <td class="num">${sub.toLocaleString("id-ID")}</td>
                    </tr>
                `;
            });

            receiptHTML += `
                </table>
                <div class="receipt-line"></div>
                <table class="receipt-table">
                    <tr><td>Subtotal</td><td class="num">Rp ${lastSubtotal.toLocaleString("id-ID")}</td></tr>
                    ${lastDiscount > 0 ? `<tr><td>Diskon</td><td class="num">-Rp ${lastDiscount.toLocaleString("id-ID")}</td></tr>` : ""}
                    <tr><td><strong>TOTAL</strong></td><td class="num"><strong>Rp ${grandTotal.toLocaleString("id-ID")}</strong></td></tr>
                    <tr><td>Bayar (${payMethod})</td><td class="num">Rp ${cash.toLocaleString("id-ID")}</td></tr>
                    <tr><td>Kembalian</td><td class="num">Rp ${change.toLocaleString("id-ID")}</td></tr>
                </table>
                <div class="receipt-line"></div>
                <div class="receipt-footer">
                    Terima Kasih Atas Kunjungan Anda!<br>
                    Barang yang sudah dibeli<br>tidak dapat ditukar/dikembalikan.
                </div>
            `;

            document.getElementById("modalReceiptContent").innerHTML = receiptHTML;
            document.getElementById("printableReceipt").innerHTML = receiptHTML;

            const receiptModal = new bootstrap.Modal(document.getElementById("receiptModal"));
            receiptModal.show();

            setTimeout(triggerPrint, 500);
        }

        function triggerPrint() {
            window.print();
        }

        document.addEventListener("keydown", function(e) {
            if (e.key === "F2") {
                e.preventDefault();
                document.getElementById("barcodeInput").focus();
            } else if (e.key === "F4") {
                e.preventDefault();
                document.getElementById("cashInput").focus();
            } else if (e.key === "Escape") {
                clearCart();
            }
        });
    </script>
</body>
</html>