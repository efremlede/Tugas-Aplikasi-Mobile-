@extends('layouts.app')

@section('content')
<div class="container-fluid p-4" style="background-color: #f1f5f9; min-height: 100vh;">
    <div class="row">
        <!-- Kolom Kiri: Input & Keranjang Belanja -->
        <div class="col-md-8">
            <h4 class="fw-bold text-dark mb-3">Tambah Barang</h4>
            
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <form id="search-form" onsubmit="addItemFromSearch(event)" class="d-flex justify-content-between align-items-center">
                        <div class="input-group me-2">
                            <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                            <input type="text" id="search-input" class="form-control border-start-0" placeholder="Cari nama barang / kategori / scan barcode..." autocomplete="off">
                        </div>
                        <button type="submit" class="btn text-white px-4 fw-bold" style="background-color: #7f1d1d; min-width: 130px;">Cari Barang</button>
                    </form>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold text-dark mb-0">Keranjang Belanja</h5>
                        <span id="badge-item-count" class="badge bg-secondary px-3 py-2">0 Item</span>
                    </div>
                    <table class="table align-middle">
                        <thead style="background-color: #e2e8f0;">
                            <tr>
                                <th class="text-secondary" style="width: 50px;">NO</th>
                                <th class="text-secondary">BARANG</th>
                                <th class="text-secondary text-end">TOTAL</th>
                                <th class="text-end text-secondary" style="width: 50px;"></th>
                            </tr>
                        </thead>
                        <tbody id="cart-table-body">
                            <!-- Rows di-render via Javascript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Ringkasan Pembayaran -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold mb-3 text-dark">Ringkasan Pembayaran</h5>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Total Item</span>
                        <span id="summary-total-item" class="fw-bold">0</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Subtotal</span>
                        <span id="summary-subtotal" class="fw-bold">Rp 0</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Biaya Lain</span>
                        <span class="fw-bold">0</span>
                    </div>
                    <hr style="border-top: 1px solid #cbd5e1;">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="fw-bold text-uppercase fs-6 text-secondary">TOTAL AKHIR</span>
                        <span id="summary-total-akhir" class="fw-bold fs-3" style="color: #b91c1c;">Rp 0</span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted small fw-semibold">Pelanggan</label>
                        <select class="form-select" id="customer-select">
                            <option value="Pelanggan umum">Pelanggan umum</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted small fw-semibold">Uang Dibayar</label>
                        <input type="number" id="input-cash" class="form-control form-control-lg text-end fw-bold" value="100000" oninput="calculateChange()">
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted small fw-semibold">Metode Pembayaran</label>
                        <div class="row g-2">
                            <div class="col-6"><button type="button" class="btn w-100 text-white btn-sm fw-bold" style="background-color: #7f1d1d;">Tunai</button></div>
                            <div class="col-6"><button type="button" class="btn w-100 btn-outline-secondary btn-sm">QRIS</button></div>
                            <div class="col-6"><button type="button" class="btn w-100 btn-outline-secondary btn-sm">Transfer</button></div>
                            <div class="col-6"><button type="button" class="btn w-100 btn-outline-secondary btn-sm">Tap NFC</button></div>
                        </div>
                    </div>

                    <div class="p-3 mb-3 rounded" style="background-color: #f0fdf4; border: 1px solid #bbf7d0;">
                        <small class="text-success fw-bold d-block mb-1">KEMBALIAN</small>
                        <h4 id="text-change" class="fw-bold text-success mb-0">Rp 0</h4>
                    </div>

                    <div class="row g-2 mb-2">
                        <div class="col-6"><button type="button" class="btn btn-warning w-100 text-dark fw-bold" style="background-color: #ca8a04;">Tahan</button></div>
                        <div class="col-6"><button type="button" class="btn text-white w-100 fw-bold" style="background-color: #991b1b;" onclick="clearCart()">Batal</button></div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="button" class="btn btn-lg text-white fw-bold py-3 shadow-sm" style="background-color: #064e3b;" onclick="openConfirmModal()">
                            BAYAR & CETAK
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL 1: KONFIRMASI PEMBAYARAN -->
<div class="modal fade" id="modalConfirm" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center p-4 rounded-4 border-0">
            <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle" style="width: 60px; height: 60px; background-color: #fef2f2; color: #991b1b;">
                <i class="bi bi-bag-check fs-2"></i>
            </div>
            <h4 class="fw-bold text-dark">Konfirmasi Pembayaran</h4>
            <p class="text-muted small">Pastikan jumlah pembayaran sudah sesuai sebelum transaksi disimpan.</p>
            
            <div class="p-3 rounded-3 text-start mb-4" style="background-color: #f8fafc; border: 1px solid #e2e8f0;">
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Jumlah item</span>
                    <span id="confirm-items" class="fw-bold">0 item</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Total belanja</span>
                    <span id="confirm-total" class="fw-bold" style="color: #b91c1c;">Rp 0</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Uang dibayar</span>
                    <span id="confirm-pay" class="fw-bold">Rp 0</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span class="text-muted">Kembalian</span>
                    <span id="confirm-change" class="fw-bold text-success">Rp 0</span>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button class="btn text-white w-50 py-2 fw-semibold" data-bs-dismiss="modal" style="background-color: #ef4444;">Periksa Lagi</button>
                <button class="btn text-white w-50 py-2 fw-semibold" style="background-color: #991b1b;" onclick="submitTransaction()">Konfirmasi & Bayar</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL 2: PEMBAYARAN BERHASIL -->
<div class="modal fade" id="modalSuccess" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center p-4 rounded-4 border-0 position-relative">
            <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
            
            <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle" style="width: 50px; height: 50px; background-color: #fef2f2; color: #991b1b;">
                <i class="bi bi-receipt fs-3"></i>
            </div>
            <h4 class="fw-bold text-dark mb-1">Pembayaran Berhasil</h4>
            <p class="text-muted small mb-4">Transaksi sudah tersimpan. Apakah Anda ingin mencetak struk untuk pelanggan?</p>
            
            <div class="p-3 rounded-3 text-start mb-4" style="background-color: #f8fafc; border: 1px solid #f1f5f9;">
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted small">No. Invoice</span>
                    <span id="success-invoice" class="fw-bold text-dark small">INV-20261030-7633</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted small">Total belanja</span>
                    <span id="success-total" class="fw-bold small" style="color: #b91c1c;">Rp 0</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span class="text-muted small">Kembalian</span>
                    <span id="success-change" class="fw-bold text-dark small">Rp 0</span>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button class="btn text-white w-50 py-2 fw-semibold" style="background-color: #ef4444; border-radius: 8px;" onclick="finishWithoutPrint()">Selesai Tanpa Cetak</button>
                <button class="btn text-white w-50 py-2 fw-semibold" style="background-color: #851414; border-radius: 8px;" onclick="triggerPrint()">
                    <i class="bi bi-printer me-1"></i> Cetak Struk
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    let cart = [];

    document.addEventListener('DOMContentLoaded', function() {
        renderCart();
    });

    function renderCart() {
        let tbody = document.getElementById('cart-table-body');
        tbody.innerHTML = '';

        let subtotal = 0;
        if (cart.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="4" class="text-center text-muted py-4">Keranjang belanja masih kosong</td>
                </tr>
            `;
        } else {
            cart.forEach((item, index) => {
                subtotal += item.price;
                let row = `
                    <tr>
                        <td>${index + 1}</td>
                        <td>
                            <strong>${item.name}</strong><br>
                            <small class="text-muted">${item.category}</small>
                        </td>
                        <td class="text-end fw-bold">Rp ${item.price.toLocaleString('id-ID')}</td>
                        <td class="text-end">
                            <button class="btn btn-sm text-danger border-0 fw-bold fs-5" onclick="removeItem(${index})">✕</button>
                        </td>
                    </tr>
                `;
                tbody.insertAdjacentHTML('beforeend', row);
            });
        }

        // Update Ringkasan Total
        document.getElementById('badge-item-count').innerText = cart.length + ' Item';
        document.getElementById('summary-total-item').innerText = cart.length;
        document.getElementById('summary-subtotal').innerText = 'Rp ' + Math.round(subtotal).toLocaleString('id-ID');
        document.getElementById('summary-total-akhir').innerText = 'Rp ' + Math.round(subtotal).toLocaleString('id-ID');

        calculateChange();
    }

    function addItemFromSearch(event) {
        event.preventDefault();
        let input = document.getElementById('search-input');
        let itemName = input.value.trim();

        if (itemName !== '') {
            cart.push({
                name: itemName,
                category: 'Semen',
                price: 65000
            });
            input.value = '';
            renderCart();
        }
    }

    function removeItem(index) {
        cart.splice(index, 1);
        renderCart();
    }

    function clearCart() {
        cart = [];
        renderCart();
    }

    function calculateChange() {
        let subtotal = Math.round(cart.reduce((sum, i) => sum + i.price, 0));
        let cash = Math.round(parseFloat(document.getElementById('input-cash').value)) || 0;
        let change = cash - subtotal;
        document.getElementById('text-change').innerText = 'Rp ' + (change > 0 ? change.toLocaleString('id-ID') : 0);
    }

    function openConfirmModal() {
        if (cart.length === 0) {
            alert('Keranjang belanja masih kosong!');
            return;
        }

        let subtotal = Math.round(cart.reduce((sum, i) => sum + i.price, 0));
        let cash = Math.round(parseFloat(document.getElementById('input-cash').value)) || 0;
        let change = cash - subtotal;

        document.getElementById('confirm-items').innerText = cart.length + ' item';
        document.getElementById('confirm-total').innerText = 'Rp ' + subtotal.toLocaleString('id-ID');
        document.getElementById('confirm-pay').innerText = 'Rp ' + cash.toLocaleString('id-ID');
        document.getElementById('confirm-change').innerText = 'Rp ' + (change > 0 ? change.toLocaleString('id-ID') : 0);

        new bootstrap.Modal(document.getElementById('modalConfirm')).show();
    }

    function submitTransaction() {
        let modalConfirmEl = document.getElementById('modalConfirm');
        let modalConfirmInstance = bootstrap.Modal.getInstance(modalConfirmEl);
        if (modalConfirmInstance) modalConfirmInstance.hide();

        let subtotal = Math.round(cart.reduce((sum, i) => sum + i.price, 0));
        let cash = Math.round(parseFloat(document.getElementById('input-cash').value)) || 0;
        let change = cash - subtotal;
        let invoice = 'INV-' + Math.floor(10000000 + Math.random() * 90000000);
        
        let now = new Date();
        let dateStr = String(now.getDate()).padStart(2, '0') + '/' + String(now.getMonth() + 1).padStart(2, '0') + '/' + now.getFullYear() + ' ' + String(now.getHours()).padStart(2, '0') + ':' + String(now.getMinutes()).padStart(2, '0');

        // SIMPAN TRANSAKSI DENGAN NILAI BULAT KE LOCALSTORAGE
        let newTransaction = {
            invoice: invoice,
            waktu: dateStr,
            pelanggan: document.getElementById('customer-select').value || 'Pelanggan umum',
            barangCount: cart.length,
            metode: 'TUNAI',
            total: subtotal,
            kembali: change > 0 ? Math.round(change) : 0
        };

        let existingHistory = JSON.parse(localStorage.getItem('pos_history')) || [];
        existingHistory.unshift(newTransaction);
        localStorage.setItem('pos_history', JSON.stringify(existingHistory));

        // UPDATE MODAL SUKSES
        document.getElementById('success-invoice').innerText = invoice;
        document.getElementById('success-total').innerText = 'Rp ' + subtotal.toLocaleString('id-ID');
        document.getElementById('success-change').innerText = 'Rp ' + (change > 0 ? Math.round(change).toLocaleString('id-ID') : 0);

        setTimeout(() => {
            new bootstrap.Modal(document.getElementById('modalSuccess')).show();
        }, 400);
    }

    function triggerPrint() {
        window.open('/print-receipt', '_blank');
        let modalSuccessEl = document.getElementById('modalSuccess');
        let modalSuccessInstance = bootstrap.Modal.getInstance(modalSuccessEl);
        if (modalSuccessInstance) modalSuccessInstance.hide();
        clearCart();
    }

    function finishWithoutPrint() {
        let modalSuccessEl = document.getElementById('modalSuccess');
        let modalSuccessInstance = bootstrap.Modal.getInstance(modalSuccessEl);
        if (modalSuccessInstance) modalSuccessInstance.hide();
        clearCart();
    }
</script>
@endsection