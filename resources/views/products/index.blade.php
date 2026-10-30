<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk - Toko Semen Jaya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .product-card { border-radius: 8px; border: 1px solid #dee2e6; }
    </style>
</head>
<body>

    <!-- Bilah Navigasi Atas (Penghubung ke Halaman Kasir) -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4 px-3 shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="{{ route('admin.products.index') }}">
                <i class="fa-solid fa-boxes-stacked me-2"></i>Toko Semen Jaya
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav ms-auto gap-2">
                    <!-- Navigasi Penghubung Utama: Buka Kasir / POS -->
                    <a class="nav-link text-white fw-bold bg-success px-3 rounded-2" href="{{ route('cashier.index') }}">
                        <i class="fa-solid fa-cash-register me-1"></i> Buka Kasir / POS
                    </a>

                    <!-- Navigasi Aktif: Halaman Produk -->
                    <a class="nav-link active fw-bold text-warning" href="{{ route('admin.products.index') }}">
                        <i class="fa-solid fa-boxes-stacked me-1"></i> Halaman Produk
                    </a>

                    <!-- Navigasi Dashboard -->
                    <a class="nav-link text-white-50" href="{{ route('cashier.dashboard') }}">
                        <i class="fa-solid fa-gauge me-1"></i> Dashboard
                    </a>

                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}" class="d-inline ms-2">
                        @csrf
                        <button type="submit" class="btn btn-outline-light btn-sm mt-1">
                            <i class="fa-solid fa-right-from-bracket me-1"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Content Halaman Produk -->
    <div class="container px-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold m-0"><i class="fa-solid fa-boxes-stacked me-2"></i>Kelola Produk & Stok</h3>
                <p class="text-muted m-0">Daftar semen dan material toko yang tersedia di sistem kasir.</p>
            </div>
            
            <div class="d-flex gap-2">
                <!-- Tombol Pintas Ke Kasir -->
                <a href="{{ route('cashier.index') }}" class="btn btn-outline-primary fw-bold">
                    <i class="fa-solid fa-cart-shopping me-1"></i> Ke Kasir
                </a>
                <button class="btn btn-primary fw-bold">
                    <i class="fa-solid fa-plus me-1"></i> Tambah Produk Baru
                </button>
            </div>
        </div>

        <!-- Tabel Daftar Produk -->
        <div class="card product-card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Kode / Barcode</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th class="text-end">Harga Jual</th>
                                <th class="text-center">Stok</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products ?? [] as $index => $product)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><code>{{ $product->code ?? 'PRD-001' }}</code></td>
                                <td class="fw-bold">{{ $product->name ?? 'Semen Tiga Roda 50kg' }}</td>
                                <td><span class="badge bg-info text-dark">{{ $product->category ?? 'Semen' }}</span></td>
                                <td class="text-end fw-bold">Rp {{ number_format($product->price ?? 65000, 0, ',', '.') }}</td>
                                <td class="text-center">
                                    <span class="badge bg-success fs-6">{{ $product->stock ?? 100 }} Zak</span>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-warning"><i class="fa-solid fa-pen-to-square"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td>1</td>
                                <td><code>SEM-TR-50</code></td>
                                <td class="fw-bold">Semen Tiga Roda 50kg</td>
                                <td><span class="badge bg-info text-dark">Semen</span></td>
                                <td class="text-end fw-bold">Rp 65.000</td>
                                <td class="text-center"><span class="badge bg-success fs-6">120 Zak</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-warning"><i class="fa-solid fa-pen-to-square"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td><code>SEM-GR-50</code></td>
                                <td class="fw-bold">Semen Gresik 50kg</td>
                                <td><span class="badge bg-info text-dark">Semen</span></td>
                                <td class="text-end fw-bold">Rp 63.000</td>
                                <td class="text-center"><span class="badge bg-success fs-6">85 Zak</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-warning"><i class="fa-solid fa-pen-to-square"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>