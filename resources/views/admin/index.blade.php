<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk - Toko Semen Jaya</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .sidebar { min-height: 100vh; background-color: #212529; color: white; }
        .sidebar a { color: #adb5bd; text-decoration: none; padding: 10px 15px; display: block; }
        .sidebar a:hover, .sidebar a.active { background-color: #0d6efd; color: white; border-radius: 4px; }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar Navigation -->
        <nav class="col-md-2 d-none d-md-block sidebar p-3">
            <h4 class="fw-bold mb-4">Toko Semen Jaya</h4>
            <small class="text-uppercase text-muted fw-bold">Menu Utama</small>
            <ul class="nav flex-column mb-4 mt-2">
                <li class="nav-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="nav-item"><a href="{{ route('admin.products.index') }}" class="active">Produk</a></li>
                <li class="nav-item"><a href="#">Kategori</a></li>
                <li class="nav-item"><a href="#">Pesanan</a></li>
                <li class="nav-item"><a href="#">User</a></li>
            </ul>
            <small class="text-uppercase text-muted fw-bold">Admin</small>
            <ul class="nav flex-column mt-2">
                <li class="nav-item"><a href="#">Kelola Admin</a></li>
                <li class="nav-item"><a href="#">Pengaturan</a></li>
                <li class="nav-item mt-3">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm w-100">Logout</button>
                    </form>
                </li>
            </ul>
        </nav>

        <!-- Main Content Area -->
        <main class="col-md-10 ms-sm-auto px-4 py-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h2 class="fw-bold m-0">Products</h2>
                    <p class="text-muted m-0">Daftar produk</p>
                </div>
                <!-- Tombol Tambah Produk -->
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary">+ Tambah Product</a>
            </div>

            <!-- Flash Message / Alert Sukses -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h5 class="fw-bold mb-0">Data Product</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-3">No</th>
                                    <th>Product</th>
                                    <th>Kategori</th>
                                    <th>Harga</th>
                                    <th>Stock</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $index => $product)
                                    <tr>
                                        <td class="ps-3">{{ $index + 1 }}</td>
                                        <td class="fw-semibold">{{ $product->name }}</td>
                                        <td>{{ $product->category }}</td>
                                        <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                        <td>{{ $product->stock }}</td>
                                        <td>
                                            <span class="badge bg-{{ $product->status == 'Aktif' ? 'success' : 'secondary' }}">
                                                {{ $product->status }}
                                            </span>
                                        </td>
                                        <td>
                                            <!-- Pengecekan Gate / Policy untuk Tombol Edit -->
                                            @can('edit-product')
                                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            @endcan

                                            <!-- Pengecekan Policy untuk Tombol Hapus -->
                                            @can('delete', $product)
                                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4 text-muted">
                                            Belum ada produk.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Bootstrap 5 JS Bundle -->
<script href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>