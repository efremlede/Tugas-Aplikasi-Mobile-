<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembelian</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            background: #f3f4f6;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            padding: 30px 16px;
        }
        .receipt {
            width: 100%;
            max-width: 420px;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            padding: 20px 18px;
        }
        .header {
            text-align: center;
            border-bottom: 2px dashed #d1d5db;
            padding-bottom: 12px;
            margin-bottom: 12px;
        }
        h1 {
            margin: 0 0 6px;
            font-size: 24px;
        }
        .meta {
            font-size: 12px;
            line-height: 1.7;
            color: #374151;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
            margin: 12px 0;
        }
        th, td {
            padding: 6px 0;
            vertical-align: top;
        }
        td:nth-child(2), td:nth-child(3) {
            text-align: right;
        }
        .summary {
            border-top: 2px dashed #d1d5db;
            padding-top: 12px;
            margin-top: 8px;
            font-size: 13px;
        }
        .row {
            display: flex;
            justify-content: space-between;
            margin: 8px 0;
        }
        .total {
            font-size: 16px;
            font-weight: 700;
            padding-top: 10px;
            border-top: 1px solid #e5e7eb;
            margin-top: 12px;
        }
        .footer {
            text-align: center;
            margin-top: 14px;
            padding-top: 12px;
            border-top: 2px dashed #d1d5db;
            font-size: 12px;
            line-height: 1.7;
            color: #4b5563;
        }
        .button-wrap {
            text-align: center;
            margin-top: 18px;
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        .btn {
            display: inline-block;
            padding: 10px 18px;
            border-radius: 8px;
            background: #0f766e;
            color: white;
            font-weight: 700;
            text-decoration: none;
        }
        .btn-print {
            border: 0;
            cursor: pointer;
            font: inherit;
        }
        @page {
            margin: 0;
        }
        @media print {
            html, body {
                width: 80mm;
                min-width: 80mm;
                margin: 0 !important;
                padding: 0 !important;
            }
            body {
                display: block;
                background: #fff;
            }
            .receipt {
                width: 80mm;
                max-width: none;
                margin: 0;
                padding: 4mm;
                border: 0;
                border-radius: 0;
                box-shadow: none;
            }
            .no-print {
                display: none;
            }
            .receipt, .header, table, .summary, .footer {
                break-inside: avoid;
            }
        }
    </style>
</head>
<body>
    <div class="receipt">
        <div class="header">
            <h1>Toko Semen Jaya</h1>
            <div class="meta">
                Jl. Raya Utama No. 45, Surabaya<br>
                Telp. 0812-3456-7890
            </div>
        </div>

        <div class="meta">
            <div>No. Transaksi: {{ $no_trx }}</div>
            <div>Tanggal: {{ $tanggal }}</div>
            <div>Kasir: Admin</div>
        </div>

        <table>
            <thead>
                <tr>
                    <th align="left">Barang</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    @php
                        $subtotal = $item['qty'] * $item['price'];
                    @endphp
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['qty'] }} x</td>
                        <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="summary">
            <div class="row">
                <span>Total</span>
                <span>Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
            </div>
            <div class="row">
                <span>Bayar</span>
                <span>Rp {{ number_format($bayar, 0, ',', '.') }}</span>
            </div>
            <div class="row">
                <span>Kembalian</span>
                <span>Rp {{ number_format($kembalian, 0, ',', '.') }}</span>
            </div>
            <div class="row total">
                <span>Jumlah Bayar</span>
                <span>Rp {{ number_format($bayar, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="footer">
            Terima kasih atas kunjungan Anda.<br>
            Barang yang sudah dibeli tidak dapat ditukar/dikembalikan.
        </div>

        <div class="button-wrap no-print">
            <button type="button" class="btn btn-print" onclick="window.print()">Cetak Struk</button>
            <a href="/" class="btn">Kembali</a>
        </div>
    </div>
</body>
</html>
