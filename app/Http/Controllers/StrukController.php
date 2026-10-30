<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StrukController extends Controller
{
    /**
     * Menampilkan/mencetak struk pembayaran
     */
    public function printReceipt($id)
    {
        $sale = null;

        // Cek secara aman apakah class model Sale tersedia
        if (class_exists('App\Models\Sale')) {
            $sale = \App\Models\Sale::with('items.product')->find($id);
        }

        // Jika data transaksi tidak ditemukan di DB / Model belum ada, gunakan data dummy untuk pengujian
        if (!$sale) {
            $sale = (object) [
                'id' => $id,
                'created_at' => now(),
                'total_price' => 65000,
                'subtotal' => 65000,
                'discount' => 0,
                'pay_amount' => 100000,
                'change_amount' => 35000,
                'payment_method' => 'tunai',
                'items' => [
                    (object) [
                        'qty' => 1,
                        'price' => 65000,
                        'product' => (object) ['name' => 'Semen Tiga Roda 50kg']
                    ]
                ]
            ];
        }

        return view('kasir.struk', compact('sale'));
    }

    /**
     * Download/Tampil Invoice
     */
    public function invoice($id)
    {
        return $this->printReceipt($id);
    }
}