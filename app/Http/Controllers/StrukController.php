<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StrukController extends Controller
{
    public function struk()
    {
        $items = [
            ['name' => 'Semen Gresik 50kg', 'qty' => 5, 'price' => 65000],
            ['name' => 'Semen Tiga Roda 40kg', 'qty' => 2, 'price' => 58000],
            ['name' => 'Paku 7cm (Kg)', 'qty' => 1, 'price' => 20000],
        ];

        $grandTotal = 0;
        foreach ($items as $item) {
            $grandTotal += $item['qty'] * $item['price'];
        }

        $bayar = 500000;
        $kembalian = $bayar - $grandTotal;

        return view('struk', [
            'no_trx' => 'TRX-' . date('YmdHis'),
            'tanggal' => date('d-m-Y H:i'),
            'items' => $items,
            'grandTotal' => $grandTotal,
            'bayar' => $bayar,
            'kembalian' => $kembalian,
        ]);
    }
}