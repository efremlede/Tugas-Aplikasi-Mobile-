<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    /**
     * Menampilkan daftar seluruh produk.
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    /**
     * Menampilkan form untuk membuat produk baru.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Menyimpan produk baru ke dalam database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'status' => 'required|string',
        ]);

        Product::create($request->all());

        return redirect()->route('admin.products.index')
                         ->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Menampilkan rincian produk tertentu.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Menampilkan form untuk mengedit produk.
     * Menggunakan Gate untuk memeriksa izin otorisasi.
     */
    public function edit(Product $product)
    {
        // Pengecekan Otorisasi Menggunakan Gate (Sesuai poin 1b modul)
        if (Gate::denies('edit-product')) {
            abort(403, 'Anda tidak memiliki izin untuk mengedit produk ini.');
        }

        return view('products.edit', compact('product'));
    }

    /**
     * Memperbarui data produk di database.
     * Menggunakan Policy untuk memverifikasi otorisasi.
     */
    public function update(Request $request, Product $product)
    {
        // Pengecekan Otorisasi Menggunakan Policy (Sesuai poin 2d modul)
        $this->authorize('update', $product);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'status' => 'required|string',
        ]);

        $product->update($request->all());

        return redirect()->route('admin.products.index')
                         ->with('success', 'Data produk berhasil diperbarui.');
    }

    /**
     * Menghapus produk dari database.
     * Menggunakan Policy untuk memverifikasi otorisasi.
     */
    public function destroy(Product $product)
    {
        // Pengecekan Otorisasi Menggunakan Policy
        $this->authorize('delete', $product);

        $product->delete();

        return redirect()->route('admin.products.index')
                         ->with('success', 'Produk berhasil dihapus.');
    }
}