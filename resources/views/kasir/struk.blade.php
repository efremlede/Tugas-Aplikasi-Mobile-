<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Transaksi - Toko Semen Jaya</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            width: 320px;
            margin: 30px auto;
            padding: 15px;
            background: #ffffff;
            border: 1px solid #d1d5db;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            color: #000000;
        }

        .text-center { text-align: center; }
        .text-end { text-align: right; }
        .fw-bold { font-weight: bold; }
        
        .divider {
            border-bottom: 1px dashed #000000;
            margin: 8px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        td {
            padding: 2px 0;
            vertical-align: top;
        }

        .header-title {
            font-size: 16px;
            font-weight: bold;
            letter-spacing: 1px;
            margin-bottom: 3px;
        }

        .footer-text {
            font-size: 12px;
            margin-top: 10px;
            line-height: 1.3;
        }
    </style>
</head>
<body>

    <!-- HEADER STRUK -->
    <div class="text-center">
        <div class="header-title">TOKO SEMEN JAYA</div>
        <div style="font-size: 12px;">Jl. Raya Semen Jaya No. 123</div>
        <div style="font-size: 12px;">Telp: 0812-3456-7890</div>
    </div>

    <div class="divider"></div>

    <!-- INFORMASI NOTA -->
    <table>
        <tr>
            <td>No. Nota</td>
            <td class="text-end">#1</td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td class="text-end">{{ date('d/m/Y H:i') }}</td>
        </tr>
        <tr>
            <td>Kasir</td>
            <td class="text-end">Efrem Mone Lede</td>
        </tr>
    </table>

    <div class="divider"></div>

    <!-- ITEM BELANJA -->
    <table>
        <tr>
            <td colspan="2" class="fw-bold">semen gersik 50kg</td>
        </tr>
        <tr>
            <td>1 x Rp 65.000</td>
            <td class="text-end">Rp 65.000</td>
        </tr>
    </table>

    <div class="divider"></div>

    <!-- TOTAL PEMBAYARAN -->
    <table>
        <tr>
            <td>Subtotal</td>
            <td class="text-end">Rp 65.000</td>
        </tr>
        <tr>
            <td class="fw-bold">Total Bayar</td>
            <td class="text-end fw-bold">Rp 65.000</td>
        </tr>
        <tr>
            <td>Bayar (TUNAI)</td>
            <td class="text-end">Rp 100.000</td>
        </tr>
        <tr>
            <td>Kembalian</td>
            <td class="text-end">Rp 35.000</td>
        </tr>
    </table>

    <div class="divider"></div>

    <!-- FOOTER STRUK -->
    <div class="text-center footer-text">
        -- Terima Kasih --<br>
        Barang yang sudah dibeli<br>
        tidak dapat<br>
        ditukar/dikembalikan
    </div>

</body>
</html>