<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembayaran #{{ $sale->id }}</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 12px;
            width: 58mm;
            margin: 0 auto;
            padding: 5px;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .line { border-bottom: 1px dashed #000; margin: 5px 0; }
        table { width: 100%; border-collapse: collapse; }
        td { padding: 2px 0; }
        @media print {
            .no-print { display: none; }
            body { width: 100%; margin: 0; }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="text-center">
        <h3 style="margin: 0;">TOKO SEMEN JAYA</h3>
        <p style="margin: 2px 0;">Jl. Raya Semen Jaya No. 123</p>
        <p style="margin: 2px 0;">Telp: 0812-3456-7890</p>
    </div>

    <div class="line"></div>

    <table>
        <tr>
            <td>No. Nota</td>
            <td class="text-right">#{{ $sale->id }}</td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td class="text-right">{{ is_string($sale->created_at) ? $sale->created_at : $sale->created_at->format('d/m/Y H:i') }}</td>
        </tr>
        <tr>
            <td>Kasir</td>
            <td class="text-right">{{ auth()->user()->name ?? 'Kasir' }}</td>
        </tr>
    </table>

    <div class="line"></div>

    <!-- Daftar Item Belanja -->
    <table>
        @foreach($sale->items as $item)
        <tr>
            <td colspan="2"><strong>{{ $item->product->name ?? 'Produk' }}</strong></td>
        </tr>
        <tr>
            <td>{{ $item->qty }} x Rp {{ number_format($item->price, 0, ',', '.') }}</td>
            <td class="text-right">Rp {{ number_format($item->qty * $item->price, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </table>

    <div class="line"></div>

    <!-- Ringkasan Pembayaran -->
    <table>
        <tr>
            <td>Subtotal</td>
            <td class="text-right">Rp {{ number_format($sale->subtotal ?? $sale->total_price, 0, ',', '.') }}</td>
        </tr>
        @if(($sale->discount ?? 0) > 0)
        <tr>
            <td>Diskon</td>
            <td class="text-right">- Rp {{ number_format($sale->discount, 0, ',', '.') }}</td>
        </tr>
        @endif
        <tr>
            <td><strong>Total Bayar</strong></td>
            <td class="text-right"><strong>Rp {{ number_format($sale->total_price, 0, ',', '.') }}</strong></td>
        </tr>
        <tr>
            <td>Bayar ({{ strtoupper($sale->payment_method ?? 'Tunai') }})</td>
            <td class="text-right">Rp {{ number_format($sale->pay_amount ?? $sale->total_price, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Kembalian</td>
            <td class="text-right">Rp {{ number_format($sale->change_amount ?? 0, 0, ',', '.') }}</td>
        </tr>
    </table>

    <div class="line"></div>

    <div class="text-center" style="margin-top: 10px;">
        <p style="margin: 2px 0;">-- Terima Kasih --</p>
        <p style="margin: 2px 0;">Barang yang sudah dibeli</p>
        <p style="margin: 2px 0;">tidak dapat ditukar/dikembalikan</p>
    </div>

    <!-- Tombol Manual Pintas -->
    <div class="no-print" style="margin-top: 15px; text-align: center;">
        <button onclick="window.print()" style="padding: 5px 10px; cursor: pointer;">Cetak Struk</button>
        <button onclick="window.close()" style="padding: 5px 10px; cursor: pointer;">Tutup</button>
    </div>

</body>
</html>