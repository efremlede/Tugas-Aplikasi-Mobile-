<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi - Toko Semen Jaya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --primary-red: #8B1E21; }
        body { background-color: #f4f5f7; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .sidebar {
            width: 240px; min-height: 100vh; position: fixed; top: 0; left: 0;
            background: var(--primary-red); color: #fff;
        }
        .brand { padding: 20px 15px; border-bottom: 1px solid rgba(255,255,255,.1); }
        .nav-link {
            color: rgba(255,255,255,.8); padding: 12px 20px; display: flex;
            align-items: center; gap: 12px; text-decoration: none;
        }
        .nav-link:hover, .nav-link.active { color: #fff; background: rgba(0,0,0,.2); }
        .main-content { margin-left: 240px; padding: 20px 30px; }
        .top-header {
            display: flex; justify-content: space-between; align-items: center;
            background: var(--primary-red); color: #fff; padding: 10px 20px;
            margin: -20px -30px 24px;
        }
        .card-custom { border: 0; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,.05); }
        @media (max-width: 768px) {
            .sidebar { width: 68px; }
            .sidebar .brand h5, .sidebar .brand small, .sidebar .nav-link span { display: none; }
            .sidebar .nav-link { justify-content: center; padding: 14px 8px; }
            .main-content { margin-left: 68px; padding: 16px; }
            .top-header { margin: -16px -16px 20px; }
        }
    </style>
</head>
<body>
    <aside class="sidebar">
        <div class="brand">
            <h5 class="fw-bold m-0"><i class="fa-solid fa-store me-2"></i><span>Toko Semen Jaya</span></h5>
            <small class="text-white-50">Sistem Informasi Kasir</small>
        </div>
        <a href="{{ route('cashier.index') }}" class="nav-link">
            <i class="fa-solid fa-cart-shopping"></i><span>Transaksi Baru</span>
        </a>
        <a href="{{ route('cashier.pelanggan') }}" class="nav-link">
            <i class="fa-solid fa-id-card"></i><span>Member NFC</span>
        </a>
        <a href="{{ route('admin.products.index') }}" class="nav-link">
            <i class="fa-solid fa-boxes-stacked"></i><span>Daftar Produk</span>
        </a>
        <a href="{{ route('cashier.riwayat') }}" class="nav-link active" aria-current="page">
            <i class="fa-solid fa-clock-rotate-left"></i><span>Riwayat Transaksi</span>
        </a>
    </aside>

    <main class="main-content">
        <header class="top-header">
            <strong>Toko Semen Jaya</strong>
            <div class="d-flex align-items-center gap-3">
                <span class="badge bg-light text-dark">
                    <i class="fa-solid fa-user me-1"></i>{{ auth()->user()->name }}
                </span>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm">
                        <i class="fa-solid fa-right-from-bracket me-1"></i>Keluar
                    </button>
                </form>
            </div>
        </header>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="fw-bold mb-1">Riwayat Transaksi</h4>
                <small class="text-muted">Daftar transaksi penjualan yang telah tercatat.</small>
            </div>
            <a href="{{ route('cashier.index') }}" class="btn btn-danger">
                <i class="fa-solid fa-plus me-1"></i>Transaksi Baru
            </a>
        </div>

        <section class="card card-custom">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-3">No. Transaksi</th>
                            <th>Tanggal</th>
                            <th>Kasir</th>
                            <th>Pembayaran</th>
                            <th>Status</th>
                            <th class="text-end pe-3">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactions as $transaction)
                            <tr>
                                <td class="ps-3 fw-semibold">{{ $transaction->transaction_number }}</td>
                                <td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                                <td>{{ $transaction->user?->name ?? 'Kasir tidak tersedia' }}</td>
                                <td>{{ ucfirst($transaction->payment_method) }}</td>
                                <td><span class="badge bg-success">{{ ucfirst($transaction->status) }}</span></td>
                                <td class="text-end pe-3">Rp {{ number_format($transaction->grand_total, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-5">
                                    Belum ada transaksi yang tercatat.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($transactions->hasPages())
                <div class="card-body border-top">
                    {{ $transactions->links() }}
                </div>
            @endif
        </section>
    </main>
</body>
</html>