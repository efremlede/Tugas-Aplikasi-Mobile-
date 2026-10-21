<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class PosController extends Controller
{
    /**
     * Menampilkan halaman katalog / kasir
     */
    public function index()
    {
        // Mengambil semua data produk dari database
        $products = Product::all();
        
        return view('cashier.index', compact('products'));
    }

    /**
     * Menambahkan produk ke dalam session keranjang (+ Keranjang)
     */
    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        // Jika produk sudah ada di keranjang, tambahkan quantity-nya
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            // Jika belum ada, tambahkan sebagai item baru
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image ?? null
            ];
        }

        // Simpan kembali data keranjang ke Session
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    /**
     * Fungsi Beli Sekarang (Menambah ke keranjang & langsung ke checkout)
     */
    public function buyNow(Request $request, $id)
    {
        // Tambahkan produk ke keranjang terlebih dahulu
        $this->addToCart($request, $id);

        // Langsung arahkan ke halaman keranjang/checkout
        return redirect()->route('cart.index')->with('success', 'Silakan lanjutkan ke proses pembayaran!');
    }

    /**
     * Menampilkan halaman keranjang belanja
     */
    public function cartIndex()
    {
        $cart = session()->get('cart', []);
        return view('cashier.cart', compact('cart'));
    }

    /**
     * Memproses transaksi / checkout
     */
    public function checkout(Request $request)
    {
        // Kosongkan keranjang setelah transaksi selesai
        session()->forget('cart');

        return redirect()->route('cashier.index')->with('success', 'Transaksi berhasil diproses!');
    }

    /**
     * Halaman checkout langsung untuk pembelian instan.
     */
    public function directCheckout()
    {
        $cart = session()->get('cart', []);

        return view('cashier.cart', compact('cart'));
    }
}