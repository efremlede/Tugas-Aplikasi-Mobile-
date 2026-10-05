<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Kasir - Toko Semen Jaya</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f3f4f6;
        }

        .navbar {
            background: #059669;
            color: white;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h2 {
            margin: 0;
        }

        .container {
            padding: 40px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }

        .logout {
            background: #dc2626;
            color: white;
            padding: 10px 18px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div class="navbar">

        <h2>Toko Semen Jaya - Kasir</h2>

        <form action="/logout" method="POST">
            @csrf

            <button type="submit" class="logout">
                Logout
            </button>
        </form>

    </div>

    <div class="container">

        <div class="card">

            <h1>Dashboard Kasir</h1>

            <p>
                Selamat datang,
                <strong>{{ auth()->user()->name }}</strong>
            </p>

            <p>
                Role:
                <strong>{{ auth()->user()->role }}</strong>
            </p>

            <hr>

            <h3>Menu Kasir</h3>

            <ul>
                <li>Melihat produk</li>
                <li>Mengelola transaksi</li>
                <li>Melakukan checkout</li>
                <li>Melihat pesanan</li>
            </ul>

        </div>

    </div>

</body>
</html>