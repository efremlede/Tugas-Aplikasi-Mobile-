<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk - Toko Semen Jaya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
        }
        .form-card {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-card">
            <h3 class="fw-bold mb-4 text-center">Tambah Produk Baru</h3>

            <form action="{{ route('admin.products.store') }}" method="POST">
                {{-- TOKEN CSRF WAJIB ADA DI SINI UNTUK CEGAH ERROR 419 --}}
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">Nama Produk</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Masukkan nama produk" required>
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label fw-semibold">Kategori</label>
                    <input type="text" class="form-control" id="category" name="category" value="{{ old('category') }}" placeholder="Contoh: Semen" required>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="price" class="form-label fw-semibold">Harga (Rp)</label>
                        <input type="number" class="form-control" id="price" name="price" value="{{ old('price') }}" placeholder="0" min="0" required>
                    </div>
                    <div class="col-md-6">
                        <label for="stock" class="form-label fw-semibold">Stok</label>
                        <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock') }}" placeholder="0" min="0" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label fw-semibold">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Nonaktif" {{ old('status') == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="description" class="form-label fw-semibold">Deskripsi</label>
                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Masukkan deskripsi produk..." required>{{ old('description') }}</textarea>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Produk</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>