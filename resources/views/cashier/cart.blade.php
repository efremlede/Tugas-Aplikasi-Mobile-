<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - Toko Semen Jaya</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold text-primary">Keranjang Belanja</h2>
                <p class="text-muted m-0">Toko Semen Jaya</p>
            </div>
            <a href="{{ route('cashier.index') }}" class="btn btn-outline-secondary">
                <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Katalog
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <!-- Table Item Keranjang -->
            <div class="col-lg-8 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-3">Produk</th>
                                        <th>Harga</th>
                                        <th class="text-center">Jumlah</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $total = 0; @endphp
                                    @if(session('cart') && count(session('cart')) > 0)
                                        @foreach(session('cart') as $id => $details)
                                            @php 
                                                $subtotal = $details['price'] * $details['quantity'];
                                                $total += $subtotal;
                                            @endphp
                                            <tr>
                                                <td class="ps-3 fw-semibold">{{ $details['name'] }}</td>
                                                <td>Rp {{ number_format($details['price'], 0, ',', '.') }}</td>
                                                <td class="text-center">{{ $details['quantity'] }}</td>
                                                <td class="fw-bold text-success">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4" class="text-center py-4 text-muted">
                                                Keranjang belanja masih kosong.
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ringkasan Pembayaran & Checkout -->
            <div class="col-lg-4">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white py-3">
                        <h5 class="card-title m-0 fw-bold">Ringkasan Pesanan</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3 fs-5">
                            <span class="fw-bold">Total Harga:</span>
                            <span class="fw-bold text-primary">Rp {{ number_format($total ?? 0, 0, ',', '.') }}</span>
                        </div>

                        <form action="{{ route('checkout.process') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary w-100 py-2 fw-bold" {{ (!session('cart') || count(session('cart')) == 0) ? 'disabled' : '' }}>
                                ⚡ Proses Transaksi / Bayar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/bootstrap.bundle.min.js"></script>
</body>
</html>