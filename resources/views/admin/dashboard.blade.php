<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Toko Semen Jaya</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        body {
            background-color: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .dashboard-card {
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            text-align: center;
        }
        .header-title {
            color: #2c3e50;
            font-size: 24px;
            margin-bottom: 20px;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 10px;
        }
        .user-info {
            background-color: #eef2f7;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: left;
        }
        .user-info p {
            margin: 6px 0;
            color: #334155;
            font-size: 15px;
        }
        .btn-logout {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 12px 20px;
            font-size: 14px;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
            width: 100%;
            transition: background 0.3s ease;
        }
        .btn-logout:hover {
            background-color: #c0392b;
        }
        .guest-box a {
            color: #3498db;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="dashboard-card">
        <h2 class="header-title">Toko Semen Jaya</h2>

        <!-- Pengecekan Pengguna yang Sedang Login -->
        @auth
            <div class="user-info">
                <p><strong>Selamat Datang!</strong></p>
                <p><strong>Nama:</strong> {{ Auth::user()->name }}</p>
                <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
            </div>

            <!-- Form Tombol Logout -->
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">Logout</button>
            </form>
        @endauth

        <!-- Tampilan Jika Belum Login -->
        @guest
            <div class="guest-box">
                <p>Anda belum terautentikasi.</p>
                <p>Silakan <a href="{{ route('login') }}">Login di sini</a> untuk mengakses dashboard.</p>
            </div>
        @endguest
    </div>

</body>
</html>