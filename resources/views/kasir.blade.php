@extends('layouts.app')

@section('content')
<div class="container-fluid p-4" style="background-color: #f1f5f9; min-height: 100vh;">
    <div class="row">
        <!-- Kolom Kiri: Input & Keranjang Belanja -->
        <div class="col-md-8">
            <h3 class="fw-bold text-dark mb-1">Transaksi Baru</h3>
            <p class="text-muted mb-4">Masukkan produk ke keranjang, lalu lanjutkan ke pembayaran</p>

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <label class="fw-semibold mb-2 text-secondary">Scan Barcode Produk Semen</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-qr-code-scan text-muted"></i></span>
                        <input type="text" id="barcode-input" class="form-control border-start-0" placeholder="Scan barcode lalu tekan Enter">
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <input type="text" id="search-input" class="form-control me-2" placeholder="Cari jenis semen, sak, atau paket...">
                        <button class="btn text-white px-4 fw-bold" style="background-color: #dc2626;">Cari Barang</button>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold mb-3 text-dark">Keranjang Belanja</h5>
                    <table class="table align-middle">
                        <thead style="background-color: #e2e8f0;">
                            <tr>
                                <th class="text-secondary">NO</th>
                                <th class="text-secondary">BARANG</th>
                                <th class="text-secondary">HARGA</th>
                                <th class="text-center text-secondary">QTY</th>
                                <th class="text-end text-secondary">ACTION</th>
                            </tr>
                        </thead>
                        <tbody id="cart-table-body">
                            <!-- Contoh item default -->
                            <tr>
                                <td>1</td>
                                <td><strong>Semen Gresik 50kg</strong><br><small class="text-muted">Bahan Bangunan</small></td>
                                <td>Rp 65.000</td>
                                <td class="text-center">2</td>
                                <td class="text-end"><button class="btn btn-sm btn-outline-danger">x</button></td>
                            </tr>
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
                        <span id="summary-total-item" class="fw-bold">2 Sak</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Subtotal</span>
                        <span id="summary-subtotal" class="fw-bold">Rp 130.000</span>
                    </div>
                    <hr style="border-top: 2px dashed #cbd5e1;">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="fw-bold text-uppercase fs-6 text-secondary">TOTAL AKHIR</span>
                        <span id="summary-total-akhir" class="fw-bold fs-3" style="color: #dc2626;">Rp 130.000</span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted small fw-semibold">Pelanggan</label>
                        <select class="form-select" id="customer-select">
                            <option value="umum">Pelanggan Umum / Kontraktor</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted small fw-semibold">Uang Dibayar</label>
                        <input type="number" id="input-cash" class="form-control form-control-lg text-end fw-bold" placeholder="150000" oninput="calculateChange()">
                    </div>

                    <div class="p-3 mb-3 rounded" style="background-color: #f0fdf4; border: 1px solid #bbf7d0;">
                        <small class="text-success fw-bold d-block mb-1">KEMBALIAN</small>
                        <h4 id="text-change" class="fw-bold text-success mb-0">Rp 20.000</h4>
                    </div>

                    <div class="d-grid gap-2">
                        <button class="btn btn-lg text-white fw-bold py-3 shadow-sm" style="background-color: #16a34a;" onclick="openConfirmModal()">
                            <i class="bi bi-printer me-2"></i>BAYAR & CETAK
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL 1: Konfirmasi Pembayaran -->
<div class="modal fade" id="modalConfirm" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center p-4 rounded-4 border-0">
            <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle" style="width: 60px; height: 60px; background-color: #fef2f2; color: #dc2626;">
                <i class="bi bi-bag-check fs-2"></i>
            </div>
            <h4 class="fw-bold text-dark">Konfirmasi Pembayaran</h4>
            <p class="text-muted small">Pastikan jumlah pembayaran semen sudah sesuai sebelum disimpan.</p>
            
            <div class="p-3 rounded-3 text-start mb-4" style="background-color: #f8fafc; border: 1px solid #e2e8f0;">
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Jumlah Item</span>
                    <span id="confirm-items" class="fw-bold">2 item</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Total Belanja</span>
                    <span id="confirm-total" class="fw-bold" style="color: #dc2626;">Rp 130.000</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Uang Dibayar</span>
                    <span id="confirm-pay" class="fw-bold">Rp 150.000</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span class="text-muted">Kembalian</span>
                    <span id="confirm-change" class="fw-bold text-success">Rp 20.000</span>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button class="btn text-white w-50 py-2 fw-semibold" data-bs-dismiss="modal" style="background-color: #64748b;">Periksa Lagi</button>
                <button class="btn text-white w-50 py-2 fw-semibold" style="background-color: #dc2626;" onclick="submitTransaction()">Konfirmasi & Bayar</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL 2: Pembayaran Berhasil -->
<div class="modal fade" id="modalSuccess" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center p-4 rounded-4 border-0">
            <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle" style="width: 60px; height: 60px; background-color: #fef2f2; color: #dc2626;">
                <i class="bi bi-receipt fs-2"></i>
            </div>
            <h4 class="fw-bold text-dark">Pembayaran Berhasil</h4>
            <p class="text-muted small">Transaksi Toko Semen Jaya telah disimpan. Cetak struk untuk pembeli?</p>
            
            <div class="p-3 rounded-3 text-start mb-4" style="background-color: #f8fafc; border: 1px solid #e2e8f0;">
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">No. Invoice</span>
                    <span id="success-invoice" class="fw-bold text-dark">INV-20261106-001</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Total Belanja</span>
                    <span id="success-total" class="fw-bold" style="color: #dc2626;">Rp 130.000</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span class="text-muted">Kembalian</span>
                    <span id="success-change" class="fw-bold text-success">Rp 20.000</span>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button class="btn text-white w-50 py-2 fw-semibold" style="background-color: #64748b;" onclick="window.location.reload()">Selesai Tanpa Cetak</button>
                <button class="btn text-white w-50 py-2 fw-semibold" style="background-color: #dc2626;" onclick="triggerPrint()">Cetak Struk</button>
            </div>
        </div>
    </div>
</div>

<script>
    let currentTotal = 130000;

    function calculateChange() {
        let cash = parseFloat(document.getElementById('input-cash').value) || 0;
        let change = cash - currentTotal;
        document.getElementById('text-change').innerText = 'Rp ' + (change > 0 ? change.toLocaleString('id-ID') : 0);
    }

    function openConfirmModal() {
        let cash = parseFloat(document.getElementById('input-cash').value) || 0;
        let change = cash - currentTotal;

        document.getElementById('confirm-items').innerText = '2 sak';
        document.getElementById('confirm-total').innerText = 'Rp ' + currentTotal.toLocaleString('id-ID');
        document.getElementById('confirm-pay').innerText = 'Rp ' + cash.toLocaleString('id-ID');
        document.getElementById('confirm-change').innerText = 'Rp ' + (change > 0 ? change.toLocaleString('id-ID') : 0);

        new bootstrap.Modal(document.getElementById('modalConfirm')).show();
    }

    function submitTransaction() {
        bootstrap.Modal.getInstance(document.getElementById('modalConfirm')).hide();

        let cash = parseFloat(document.getElementById('input-cash').value) || 0;
        let change = cash - currentTotal;

        document.getElementById('success-invoice').innerText = 'INV-' + Math.floor(Math.random() * 899999 + 100000);
        document.getElementById('success-total').innerText = 'Rp ' + currentTotal.toLocaleString('id-ID');
        document.getElementById('success-change').innerText = 'Rp ' + (change > 0 ? change.toLocaleString('id-ID') : 0);

        new bootstrap.Modal(document.getElementById('modalSuccess')).show();
    }

    function triggerPrint() {
        window.open('/print-receipt', '_blank');
        window.location.reload();
    }
</script>
@endsection