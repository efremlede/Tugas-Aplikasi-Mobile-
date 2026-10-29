<?php

namespace App\Http\Controllers;

use App\Contracts\ReceiptPrinter;
use App\Models\Sale;
use App\Models\StoreSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;
use Barryvdh\DomPDF\Facade\Pdf;

class StrukController extends Controller
{
    /**
     * Fungsi dari Gambar 1 (Generate PDF Invoice)
     * Sudah disesuaikan menggunakan model Sale agar klop dengan proyek Anda.
     */
    public function invoice(Sale $sale)
    {
        // Mengambil data sale beserta item dan produknya (disesuaikan dengan relasi Laravel Anda)
        $sale = Sale::with('items.product')->findOrFail($sale->id);

        // Menyamakan variabel ke $invoice seperti pada instruksi gambar 1
        $invoice = $sale;

        foreach ($invoice->items as $item) {
            // memastikan field 'total' ada pada tiap item
            if (!isset($item->total)) {
                $item->total = $item->subtotal ?? ($item->price * $item->quantity);
            }
        }

        // Sesuaikan grand total dari database proyek Anda (biasanya total_amount atau grand_total)
        $invoice->total = $invoice->total_amount ?? $invoice->total ?? 0;

        // Load view template HTML invoice (Pastikan file blade ditaruh di resources/views/invoices/invoice.blade.php)
        $pdf = Pdf::loadView('invoices.invoice', ['invoice' => $invoice]);

        // Download otomatis file PDF-nya
        return $pdf->download('invoice_' . $invoice->id . '.pdf');
    }
}