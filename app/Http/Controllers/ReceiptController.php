<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\DummyPrintConnector;

class ReceiptController extends Controller
{
    public function print(Request $request)
    {
        $noTrx = 'TRX-' . now()->format('YmdHis');
        $tanggal = now()->format('d/m/Y H:i');
        $items = [
            ['name' => 'semen gersik 50kg', 'qty' => 1, 'price' => 65000],
        ];
        $grandTotal = collect($items)->sum(fn (array $item) => $item['qty'] * $item['price']);
        $bayar = 100000;
        $kembalian = $bayar - $grandTotal;
        $kasir = auth()->user()->name ?? 'Kasir';

        try {
            // Jalankan pencetakan simulasi ESC/POS di background
            $connector = new DummyPrintConnector();
            $printer = new Printer($connector);

            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->setEmphasis(true);
            $printer->text("TOKO SEMEN JAYA\n");
            $printer->setEmphasis(false);
            $printer->text("Jl. Raya Semen Jaya No. 123\n");
            $printer->text("Telp: 0812-3456-7890\n");
            $printer->text("--------------------------------\n");

            $printer->setJustification(Printer::JUSTIFY_LEFT);
            $printer->text("No. Nota   : {$noTrx}\n");
            $printer->text("Tanggal    : {$tanggal}\n");
            $printer->text("Kasir      : {$kasir}\n");
            $printer->text("--------------------------------\n");

            foreach ($items as $item) {
                $itemSubtotal = $item['qty'] * $item['price'];
                $printer->text($item['name'] . "\n");
                $printer->text($item['qty'] . " x Rp " . number_format($item['price'], 0, ',', '.') .
                    "          Rp " . number_format($itemSubtotal, 0, ',', '.') . "\n");
            }
            $printer->text("--------------------------------\n");

            $printer->text("Subtotal     :         Rp " . number_format($grandTotal, 0, ',', '.') . "\n");
            $printer->setEmphasis(true);
            $printer->text("Total Bayar  :         Rp " . number_format($grandTotal, 0, ',', '.') . "\n");
            $printer->setEmphasis(false);
            $printer->text("Bayar (TUNAI):        Rp " . number_format($bayar, 0, ',', '.') . "\n");
            $printer->text("Kembalian    :         Rp " . number_format($kembalian, 0, ',', '.') . "\n");
            $printer->text("--------------------------------\n");

            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->text("-- Terima Kasih --\n");
            $printer->text("Barang yang sudah dibeli\n");
            $printer->text("tidak dapat\n");
            $printer->text("ditukar/dikembalikan\n");

            $printer->cut();
            $printer->close();

            // Tampilkan View Struk Bersih (Sesuai Gambar Rujukan Pertama)
            return view('struk', [
                'no_trx' => $noTrx,
                'tanggal' => $tanggal,
                'items' => $items,
                'grandTotal' => $grandTotal,
                'bayar' => $bayar,
                'kembalian' => $kembalian,
                'kasir' => $kasir,
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}