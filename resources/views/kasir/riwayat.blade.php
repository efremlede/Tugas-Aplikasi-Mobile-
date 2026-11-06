@extends('layouts.app')

@section('content')
<div class="container-fluid p-4" style="background-color: #f1f5f9; min-height: 100vh;">
    <h3 class="fw-bold text-dark mb-1">Riwayat Transaksi</h3>
    <p class="text-muted mb-4">Daftar transaksi yang telah diproses oleh akun kasir ini.</p>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h5 class="fw-bold mb-3 text-dark">Transaksi Tersimpan</h5>
            
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead style="background-color: #fee2e2;">
                        <tr>
                            <th class="text-secondary">INVOICE / WAKTU</th>
                            <th class="text-secondary">PELANGGAN</th>
                            <th class="text-secondary">BARANG</th>
                            <th class="text-secondary">METODE</th>
                            <th class="text-secondary">TOTAL</th>
                            <th class="text-secondary">KEMBALI</th>
                            <th class="text-center text-secondary">AKSI</th>
                        </tr>
                    </thead>
                    <tbody id="history-table-body">
                        <!-- Data di-render via Javascript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        renderHistory();
    });

    function renderHistory() {
        let history = JSON.parse(localStorage.getItem('pos_history')) || [
            {
                invoice: 'INV-20261030-7633',
                waktu: '30/10/2026 14:20',
                pelanggan: 'Pelanggan umum',
                barangCount: 1,
                metode: 'TUNAI',
                total: 65000,
                kembali: 35000
            }
        ];

        let tbody = document.getElementById('history-table-body');
        tbody.innerHTML = '';

        history.forEach(item => {
            // Membulatkan total dan kembali agar pas angka bulat
            let totalFixed = Math.round(Number(item.total) || 0);
            let kembaliFixed = Math.round(Number(item.kembali) || 0);

            let row = `
                <tr>
                    <td>
                        <strong class="text-dark">${item.invoice}</strong><br>
                        <small class="text-muted">${item.waktu}</small>
                    </td>
                    <td>${item.pelanggan}</td>
                    <td>${item.barangCount} item</td>
                    <td><span class="badge bg-secondary">${item.metode}</span></td>
                    <td class="fw-bold" style="color: #b91c1c;">Rp ${totalFixed.toLocaleString('id-ID')}</td>
                    <td>Rp ${kembaliFixed.toLocaleString('id-ID')}</td>
                    <td class="text-center">
                        <a href="/print-receipt" target="_blank" class="btn text-white btn-sm px-3" style="background-color: #dc2626; border-radius: 6px;">
                            <i class="bi bi-printer me-1"></i> Cetak struk
                        </a>
                    </td>
                </tr>
            `;
            tbody.insertAdjacentHTML('beforeend', row);
        });
    }
</script>
@endsection