<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Checkout - Toko Semen Jaya</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            color: #333;
        }

        .navbar {
            background: #c62828;
            color: white;
            padding: 18px 8%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
        }

        .container {
            width: 84%;
            margin: 40px auto;
        }

        h1 {
            margin-bottom: 25px;
        }

        .checkout {
            display: grid;
            grid-template-columns: 1.5fr 1fr;
            gap: 25px;
        }

        .box {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
        }

        .box h2 {
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
        }

        textarea {
            height: 100px;
            resize: vertical;
        }

        .product {
            border-bottom: 1px solid #ddd;
            padding: 15px 0;
        }

        .product-name {
            font-weight: bold;
        }

        .price {
            color: #c62828;
            font-weight: bold;
        }

        .total {
            margin-top: 20px;
            padding-top: 15px;
            border-top: 2px solid #ddd;
            font-size: 22px;
            font-weight: bold;
        }

        .btn {
            width: 100%;
            background: #c62828;
            color: white;
            border: none;
            padding: 14px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            margin-top: 20px;
        }

        .btn:hover {
            background: #a91f1f;
        }

        @media (max-width: 768px) {

            .navbar {
                flex-direction: column;
                gap: 15px;
            }

            .container {
                width: 92%;
            }

            .checkout {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar">

        <strong>Toko Semen Jaya</strong>

        <div>
            <a href="/">Home</a>
            <a href="/products">Produk</a>
            <a href="/cart">Keranjang</a>
        </div>

    </nav>


    <div class="container">

        <h1>Checkout</h1>

        <div class="checkout">

            <!-- FORM PELANGGAN -->

            <div class="box">

                <h2>Data Pelanggan</h2>

                <form action="/checkout" method="POST">

                    @csrf

                    <div class="form-group">

                        <label>
                            Nama Pelanggan
                        </label>

                        <input
                            type="text"
                            name="name"
                            placeholder="Masukkan nama lengkap"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label>
                            Nomor HP
                        </label>

                        <input
                            type="text"
                            name="phone"
                            placeholder="Contoh: 081234567890"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label>
                            Alamat Lengkap
                        </label>

                        <textarea
                            name="address"
                            placeholder="Masukkan alamat lengkap"
                            required
                        ></textarea>

                    </div>


                    <div class="form-group">

                        <label>
                            Kota
                        </label>

                        <input
                            type="text"
                            name="city"
                            placeholder="Masukkan kota"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label>
                            Metode Pembayaran
                        </label>

                        <select name="payment_method" required>

                            <option value="">
                                -- Pilih Pembayaran --
                            </option>

                            <option value="transfer">
                                Transfer Bank
                            </option>

                            <option value="cod">
                                COD
                            </option>

                            <option value="qris">
                                QRIS
                            </option>

                        </select>

                    </div>


                    <button type="submit" class="btn">
                        Buat Pesanan
                    </button>

                </form>

            </div>


            <!-- RINGKASAN PESANAN -->

            <div class="box">

                <h2>Ringkasan Pesanan</h2>

                @php
                    $total = 0;
                @endphp


                @foreach($cart as $id => $item)

                    @php
                        $subtotal = $item['price'] * $item['quantity'];
                        $total += $subtotal;
                    @endphp

                    <div class="product">

                        <p class="product-name">
                            {{ $item['name'] }}
                        </p>

                        <p>
                            Jumlah: {{ $item['quantity'] }}
                        </p>

                        <p class="price">
                            Rp {{ number_format($subtotal, 0, ',', '.') }}
                        </p>

                    </div>

                @endforeach


                <div class="total">

                    Total:

                    <br>

                    <span class="price">
                        Rp {{ number_format($total, 0, ',', '.') }}
                    </span>

                </div>

            </div>

        </div>

    </div>

</body>

</html>