<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    /**
     * Tampilkan dan cetak PDF Invoice berdasarkan Order ID
     */
    public function invoice(Order $order)
    {
        // 1. Ambil data order beserta relasi items dan product
        $order = Order::with('items.product')->findOrFail($order->id);

        // 2. Normalisasi total per item dan total akhir
        $invoice = $order;
        foreach ($invoice->items as $item) {
            if (!isset($item->total)) {
                $item->total = $item->subtotal ?? ($item->quantity * $item->price);
            }
        }

        if (!isset($invoice->total)) {
            $invoice->total = $invoice->total_price ?? $invoice->items->sum('total');
        }

        // 3. Render ke PDF dengan ukuran A4
        $pdf = Pdf::loadView('invoices.invoice', compact('invoice'));
        $pdf->setPaper('a4', 'portrait');

        // 4. Langsung tampilkan preview PDF di browser (gunakan download() jika ingin mengunduh otomatis)
        return $pdf->stream('Invoice-' . $invoice->id . '.pdf');
    }
}