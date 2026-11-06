<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\PrintConnectors\DummyPrintConnector;

class ReceiptController extends Controller
{
    /**
     * Mencetak struk otomatis dari backend PHP (ESC/POS)
     */
    public function print(Request $request)
    {
        try {
            // Gunakan DummyPrintConnector untuk simulasi tanpa printer fisik, 
            // atau ganti ke WindowsPrintConnector("POS-58") jika menggunakan printer USB.
            $connector = new DummyPrintConnector();
            $printer = new Printer($connector);

            // 1. Header: Nama Toko & Informasi
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->setEmphasis(true);
            $printer->text("KOPI KITA\n"); // Nama toko sesuai studi kasus
            $printer->setEmphasis(false);
            $printer->text("Jl. Pemuda No. 45, Jawa Timur\n");
            $printer->text("Telp: 0812-9999-8888\n");
            $printer->text("==============================\n");

            // 2. Tanggal & Waktu Transaksi
            $printer->setJustification(Printer::JUSTIFY_LEFT);
            $printer->text("Waktu  : " . date('d/m/Y H:i:s') . "\n");
            $printer->text("Kasir  : " . (auth()->user()->name ?? 'Kasir Utama') . "\n");
            $printer->text("------------------------------\n");

            // 3. Daftar Item, Kuantitas, dan Harga
            $items = [
                ['name' => 'Kopi Susu Aren', 'qty' => 2, 'price' => 18000],
                ['name' => 'Croissant Cokelat', 'qty' => 1, 'price' => 15000],
            ];

            $subtotal = 0;
            foreach ($items as $item) {
                $itemSubtotal = $item['qty'] * $item['price'];
                $subtotal += $itemSubtotal;

                $printer->text($item['name'] . "\n");
                $printer->text("  " . $item['qty'] . " x " . number_format($item['price'], 0, ',', '.') . 
                               str_pad("Rp " . number_format($itemSubtotal, 0, ',', '.'), 18, " ", STR_PAD_LEFT) . "\n");
            }

            $printer->text("------------------------------\n");

            // 4. Perhitungan Diskon & Total Pembayaran
            $diskon = 5000; // Contoh nilai diskon
            $totalBayar = $subtotal - $diskon;
            $bayar = 50000;
            $kembali = $bayar - $totalBayar;

            $printer->text("Subtotal     : Rp " . number_format($subtotal, 0, ',', '.') . "\n");
            $printer->text("Diskon       : Rp " . number_format($diskon, 0, ',', '.') . "\n");
            $printer->setEmphasis(true);
            $printer->text("Total Bayar  : Rp " . number_format($totalBayar, 0, ',', '.') . "\n");
            $printer->setEmphasis(false);
            $printer->text("Uang Dibayar : Rp " . number_format($bayar, 0, ',', '.') . "\n");
            $printer->text("Kembalian    : Rp " . number_format($kembali, 0, ',', '.') . "\n");
            $printer->text("==============================\n");

            // 5. Footer / Penutup
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->text("Terima Kasih Atas Kunjungan Anda!\n");
            $printer->text("--- Nikmati Kopi Kita Hari Ini ---\n\n");

            // Cut kertas & tutup koneksi printer
            $printer->cut();
            $printer->close();

            return response()->json([
                'status' => 'success',
                'message' => 'Struk transaksi otomatis berhasil dicetak via backend ESC/POS'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}