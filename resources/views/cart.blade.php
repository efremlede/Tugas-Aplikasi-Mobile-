<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Keranjang - Toko Semen Jaya</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
            color: #333;
        }

        .navbar {
            background: #c62828;
            color: white;
            padding: 18px 8%;
            display: flex;
            justify-content: space-between;
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

        .cart-box {
            background: white;
            padding: 25px;
            border-radius: 10px;
        }

        .item {
            border-bottom: 1px solid #ddd;
            padding: 20px 0;
            display: flex;
            justify-content: space-between;
        }

        .price {
            color: #c62828;
            font-weight: bold;
        }

        .total {
            text-align: right;
            margin-top: 25px;
            font-size: 22px;
            font-weight: bold;
        }

        .btn {
            display: inline-block;
            background: #c62828;
            color: white;
            padding: 12px 20px;
            border-radius: 6px;
            text-decoration: none;
            border: none;
            margin-top: 15px;
        }

        .empty {
            text-align: center;
            padding: 40px;
        }

        @media (max-width: 768px) {
            .container {
                width: 92%;
            }

            .item {
                flex-direction: column;
                gap: 10px;
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

        <h1>Keranjang Belanja</h1>

        <br>

        <div class="cart-box">

            @if(count($cart) > 0)

                @php
                    $total = 0;
                @endphp

                @foreach($cart as $id => $item)

                    @php
                        $subtotal = $item['price'] * $item['quantity'];
                        $total += $subtotal;
                    @endphp

                    <div class="item">

                        <div>
                            <h3>
                                {{ $item['name'] }}
                            </h3>

                            <p>
                                Jumlah: {{ $item['quantity'] }}
                            </p>

                            <p class="price">
                                Rp {{ number_format($item['price'], 0, ',', '.') }}
                            </p>
                        </div>

                        <div>

                            <strong>
                                Subtotal
                            </strong>

                            <p class="price">
                                Rp {{ number_format($subtotal, 0, ',', '.') }}
                            </p>

                        </div>

                    </div>

                @endforeach


                <div class="total">

                    Total:
                    Rp {{ number_format($total, 0, ',', '.') }}

                    <br>

                    <a href="/checkout" class="btn">
                        Checkout
                    </a>

                </div>

            @else

                <div class="empty">

                    <h2>
                        Keranjang masih kosong
                    </h2>

                    <p>
                        Silakan pilih produk terlebih dahulu.
                    </p>

                    <a href="/products" class="btn">
                        Lihat Produk
                    </a>

                </div>

            @endif

        </div>

    </div>

</body>
</html>