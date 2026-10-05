<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Menampilkan halaman utama transaksi kasir
     */
    public function index()
    {
        return view('admin.index');
    }

    /**
     * Menyimpan data transaksi beserta detail belanja ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'cart' => 'required|array|min:1',
            'paid_amount' => 'required|numeric',
            'payment_method' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            // 1. Simpan header transaksi
            $transaction = Transaction::create([
                'transaction_number' => 'TRX-' . date('YmdHis'),
                'user_id' => auth()->id() ?? 1,
                'customer_id' => $request->customer_id ?? null,
                'subtotal' => $request->subtotal,
                'discount' => $request->discount ?? 0,
                'tax' => $request->tax ?? 0,
                'other_fee' => $request->other_fee ?? 0,
                'grand_total' => $request->grand_total,
                'paid_amount' => $request->paid_amount,
                'change_amount' => $request->change_amount,
                'payment_method' => $request->payment_method,
                'status' => 'completed'
            ]);

            // 2. Simpan rincian barang & kurangi stok
            foreach ($request->cart as $item) {
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $item['id'],
                    'product_code' => $item['code'],
                    'product_name' => $item['name'],
                    'price' => $item['price'],
                    'qty' => $item['qty'],
                    'discount' => $item['discount'] ?? 0,
                    'subtotal' => $item['price'] * $item['qty']
                ]);

                // Potong stok di tabel products
                Product::where('id', $item['id'])->decrement('stock', $item['qty']);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil disimpan',
                'redirect' => route('transaksi.print', $transaction->id)
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan transaksi: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Menampilkan dan mencetak struk transaksi
     */
    public function print($id)
    {
        $transaction = Transaction::with('details')->findOrFail($id);
        return view('admin.print', compact('transaction'));
    }
}