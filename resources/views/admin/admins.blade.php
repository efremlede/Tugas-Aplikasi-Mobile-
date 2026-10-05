<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kelola Admin - Toko Semen Jaya</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f1f5f9;
            color: #1e293b;
        }

        /* HEADER */
        .header {
            height: 95px;
            background: #20252b;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 35px;
        }

        .logo {
            font-size: 30px;
            font-weight: bold;
        }

        .admin {
            font-size: 20px;
            font-weight: bold;
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            top: 95px;
            left: 0;
            width: 320px;
            height: calc(100vh - 95px);
            background: #263548;
            color: white;
            padding-top: 30px;
            overflow-y: auto;
        }

        .menu-title {
            padding: 0 30px 25px;
            font-size: 18px;
            font-weight: bold;
            color: #cbd5e1;
        }

        .menu {
            display: block;
            text-decoration: none;
            color: white;
            padding: 18px 35px;
            font-size: 20px;
            transition: 0.2s;
        }

        .menu:hover {
            background: #1976f3;
        }

        .menu.active {
            background: #1976f3;
        }

        .menu-icon {
            display: inline-block;
            width: 40px;
        }

        .admin-title {
            margin-top: 25px;
            padding: 20px 30px;
            border-top: 1px solid #405064;
            color: #cbd5e1;
            font-weight: bold;
        }

        /* CONTENT */
        .content {
            margin-left: 320px;
            padding: 50px 60px;
        }

        .content h1 {
            font-size: 50px;
            margin-bottom: 10px;
        }

        .subtitle {
            font-size: 25px;
            color: #64748b;
            margin-bottom: 40px;
        }

        /* CARD */
        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.08);
            overflow: hidden;
        }

        .card-header {
            padding: 30px;
            border-bottom: 1px solid #e2e8f0;
        }

        .card-header h2 {
            font-size: 28px;
            margin-bottom: 8px;
        }

        .card-header p {
            color: #64748b;
            font-size: 18px;
        }

        /* BUTTON */
        .button-area {
            padding: 25px 30px;
            text-align: right;
        }

        .btn-tambah {
            display: inline-block;
            background: #1976f3;
            color: white;
            text-decoration: none;
            padding: 13px 22px;
            border-radius: 7px;
            font-size: 17px;
            font-weight: bold;
        }

        .btn-tambah:hover {
            background: #0d63d8;
        }

        /* TABLE */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #f8fafc;
            text-align: left;
            padding: 18px;
            font-size: 17px;
            border-top: 1px solid #e2e8f0;
            border-bottom: 1px solid #e2e8f0;
        }

        td {
            padding: 20px 18px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 17px;
        }

        .status {
            display: inline-block;
            padding: 7px 13px;
            border-radius: 20px;
            background: #22c55e;
            color: white;
            font-weight: bold;
            font-size: 14px;
        }

        .btn-edit {
            background: #fbbf24;
            color: white;
            padding: 9px 14px;
            border-radius: 6px;
            text-decoration: none;
            margin-right: 5px;
        }

        .btn-hapus {
            background: #ef4444;
            color: white;
            padding: 9px 14px;
            border-radius: 6px;
            text-decoration: none;
        }

        /* RESPONSIVE */
        @media (max-width: 900px) {
            .sidebar {
                width: 230px;
            }

            .content {
                margin-left: 230px;
                padding: 30px;
            }
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <div class="header">

        <div class="logo">
            Toko Semen Jaya
        </div>

        <div class="admin">
            👤 Admin ▾
        </div>

    </div>


    <!-- SIDEBAR -->
    <div class="sidebar">

        <div class="menu-title">
            MENU UTAMA
        </div>

        <a href="{{ url('/admin') }}" class="menu">
            <span class="menu-icon">🏠</span>
            Dashboard
        </a>

        <a href="{{ url('/products') }}" class="menu">
            <span class="menu-icon">📦</span>
            Produk
        </a>

        <a href="#" class="menu">
            <span class="menu-icon">🏷️</span>
            Kategori
        </a>

        <a href="#" class="menu">
            <span class="menu-icon">🛒</span>
            Pesanan
        </a>

        <a href="#" class="menu">
            <span class="menu-icon">👥</span>
            User
        </a>


        <div class="admin-title">
            ADMIN
        </div>

        <!-- KELOLA ADMIN -->
        <a href="{{ url('/admin/admins') }}" class="menu active">
            <span class="menu-icon">👤</span>
            Kelola Admin
        </a>

        <!-- PENGATURAN -->
        <a href="{{ url('/admin/settings') }}" class="menu">
            <span class="menu-icon">⚙️</span>
            Pengaturan
        </a>

    </div>


    <!-- CONTENT -->
    <div class="content">

        <h1>Kelola Admin</h1>

        <div class="subtitle">
            Kelola data administrator Toko Semen Jaya
        </div>


        <div class="card">

            <div class="card-header">

                <h2>Data Admin</h2>

                <p>
                    Daftar administrator yang dapat mengelola toko.
                </p>

            </div>


            <div class="button-area">

                <a href="#" class="btn-tambah">
                    + Tambah Admin
                </a>

            </div>


            <table>

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Admin</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <td>1</td>

                        <td>
                            <strong>Admin Toko</strong>
                        </td>

                        <td>
                            admin@tokosemenjaya.com
                        </td>

                        <td>
                            Administrator
                        </td>

                        <td>
                            <span class="status">
                                Aktif
                            </span>
                        </td>

                        <td>

                            <a href="#" class="btn-edit">
                                Edit
                            </a>

                            <a href="#" class="btn-hapus">
                                Hapus
                            </a>

                        </td>
                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</body>
</html>