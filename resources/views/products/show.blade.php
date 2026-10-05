@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Detail Product</h1>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table">
                <tr>
                    <th width="200"@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-info text-white py-3">
                    <h5 class="mb-0 fw-bold">Detail Product</h5>
                </div>
                <div class="card-body p-4">
                    <h3 class="fw-bold text-dark">{{ $product->name }}</h3>
                    <p class="text-muted">{{ $product->description }}</p>

                    <hr>

                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Kategori:</div>
                        <div class="col-md-8">{{ $product->category }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Harga:</div>
                        <div class="col-md-8">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Stock:</div>
                        <div class="col-md-8">{{ $product->stock }} unit</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Status:</div>
                        <div class="col-md-8">
                            @if($product->status == 'Aktif')
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Nonaktif</span>
                            @endif
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning text-white">Edit Product</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection>Nama</th>
                    <td>{{ $product->name }}</td>
                </tr>
                <tr>
                    <th>Kategori</th>
                    <td>{{ $product->category ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <td>{{ $product->description ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Harga</th>
                    <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Stock</th>
                    <td>{{ $product->stock }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        @if($product->is_active)
                            <span class="badge bg-success">Aktif</span>
                        @else
                            <span class="badge bg-secondary">Tidak Aktif</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Dibuat</th>
                    <td>{{ $product->created_at->format('d-m-Y H:i') }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection