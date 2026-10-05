<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Transaksi #{{ $transaction->transaction_number }}</title>
    <style>
        @page {
            margin: 0;
        }
        body {
            font-family: 'Courier New', Courier, monospace;
            width: 58mm;
            font-size: 11px;
            margin: 0 auto;
            padding: 8px;
            color: #000;
        }
        .text-center { text-align: center; }
        .text-end { text-align: right; }
        .line { 
            border-bottom: 1px dashed #000; 
            margin: 6px 0; 
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
        }
        td { 
            vertical-align: top; 
            padding: 1px 0;
        }
        .fw-bold { font-weight: bold; }
        
        /* Menyembunyikan elemen saat dicetak */
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body onload="window.print()">

    <!-- Tombol manual jika cetak otomatis tertutup -->
    <div class="no-print" style="margin-bottom: 10px; text-align: center;">
        <button onclick="window.print()" style="padding: 5px 10px; cursor: pointer;">Cetak Struk</button>
        <button onclick="window.close()" style="padding: 5px 10px; cursor: pointer;">Tutup</button>
    </div>

    <!-- Header Struk -->
    <div class="text-center">
        <strong style="font-size: 13px;">TOKO SEMEN JAYA</strong><br>
        <small>Jl. Contoh No. 123, Kupang</small><br>
        <small>Telp: 0812-xxxx-xxxx</small>
    </div>

    <div class="line"></div>

    <!-- Info Transaksi -->
    <div>
        No   : {{ $transaction->transaction_number }}<br>
        Tgl  : {{ $transaction->created_at->format('d/m/Y H:i') }}<br>
        Kasir: {{ $transaction->user->name ?? 'Admin' }}
    </div>

    <div class="line"></div>

    <!-- Item Belanja -->
    <table>
        @foreach($transaction->details as $detail)
        <tr>
            <td colspan="2" class="fw-bold">{{ $detail->product_name }}</td>
        </tr>
        <tr>
            <td>{{ $detail->qty }} x {{ number_format($detail->price, 0, ',', '.') }}</td>
            <td class="text-end">{{ number_format($detail->subtotal, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </table>

    <div class="line"></div>

    <!-- Ringkasan Pembayaran -->
    <table>
        <tr>
            <td>Subtotal</td>
            <td class="text-end">{{ number_format($transaction->subtotal, 0, ',', '.') }}</td>
        </tr>
        @if($transaction->discount > 0)
        <tr>
            <td>Diskon</td>
            <td class="text-end">-{{ number_format($transaction->discount, 0, ',', '.') }}</td>
        </tr>
        @endif
        @if($transaction->tax > 0)
        <tr>
            <td>PPN</td>
            <td class="text-end">{{ number_format($transaction->tax, 0, ',', '.') }}</td>
        </tr>
        @endif
        @if($transaction->other_fee > 0)
        <tr>
            <td>Biaya Lain</td>
            <td class="text-end">{{ number_format($transaction->other_fee, 0, ',', '.') }}</td>
        </tr>
        @endif
        <tr>
            <td class="fw-bold">TOTAL</td>
            <td class="text-end fw-bold">{{ number_format($transaction->grand_total, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Bayar ({{ strtoupper($transaction->payment_method) }})</td>
            <td class="text-end">{{ number_format($transaction->paid_amount, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Kembali</td>
            <td class="text-end">{{ number_format($transaction->change_amount, 0, ',', '.') }}</td>
        </tr>
    </table>

    <div class="line"></div>

    <!-- Footer Struk -->
    <div class="text-center">
        <small>Terima Kasih Atas Kunjungan Anda</small><br>
        <small>Barang yang sudah dibeli tidak dapat ditukar/dikembalikan</small>
    </div>

</body>
</html>