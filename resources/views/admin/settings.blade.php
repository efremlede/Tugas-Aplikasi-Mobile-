<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Pengaturan - Toko Semen Jaya</title>


    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }


        body {
            background: #f4f6f9;
            color: #1f2937;
        }


        /* HEADER */

        .header {
            height: 70px;

            background: #20252b;

            color: white;

            display: flex;

            align-items: center;

            justify-content: space-between;

            padding: 0 40px;

            position: fixed;

            top: 0;
            left: 0;
            right: 0;

            z-index: 1000;
        }


        .logo {
            font-size: 28px;

            font-weight: bold;
        }


        .admin {
            font-size: 17px;
        }


        /* SIDEBAR */

        .sidebar {
            position: fixed;

            top: 70px;

            left: 0;

            width: 250px;

            height: calc(100vh - 70px);

            background: #273444;

            color: white;

            padding-top: 30px;

            overflow-y: auto;
        }


        .menu-title {
            padding: 0 30px 15px;

            color: #b8c2cc;

            font-size: 13px;

            font-weight: bold;
        }


        .sidebar a {
            display: block;

            color: white;

            text-decoration: none;

            padding: 16px 30px;

            font-size: 16px;
        }


        .sidebar a:hover {
            background: #34495e;
        }


        .sidebar a.active {
            background: #1677f9;
        }


        .menu-icon {
            display: inline-block;

            width: 32px;
        }


        .divider {
            height: 1px;

            background: #465361;

            margin: 15px 20px;
        }


        /* CONTENT */

        .content {
            margin-left: 250px;

            padding: 110px 45px 50px;
        }


        .page-header {
            margin-bottom: 30px;
        }


        .page-header h1 {
            font-size: 42px;

            margin-bottom: 8px;
        }


        .page-header p {
            color: #687385;

            font-size: 18px;
        }


        /* CARD */

        .card {
            background: white;

            border-radius: 10px;

            padding: 30px;

            margin-bottom: 25px;

            box-shadow:
                0 2px 10px
                rgba(0,0,0,0.08);
        }


        .card h2 {
            font-size: 24px;

            margin-bottom: 10px;
        }


        .card-description {
            color: #687385;

            margin-bottom: 25px;
        }


        /* FORM */

        .form-group {
            margin-bottom: 20px;
        }


        .form-group label {
            display: block;

            margin-bottom: 8px;

            font-weight: bold;
        }


        .form-group input,
        .form-group select {
            width: 100%;

            padding: 13px 15px;

            border: 1px solid #d6dce3;

            border-radius: 7px;

            font-size: 15px;

            outline: none;
        }


        .form-group input:focus,
        .form-group select:focus {
            border-color: #1677f9;
        }


        /* BUTTON */

        .btn {
            border: none;

            padding: 12px 20px;

            border-radius: 7px;

            cursor: pointer;

            font-size: 15px;

            font-weight: bold;
        }


        .btn-primary {
            background: #1677f9;

            color: white;
        }


        .btn-primary:hover {
            background: #0d63d5;
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
        👤 <strong>Admin</strong> ▾
    </div>

</div>



<!-- SIDEBAR -->

<div class="sidebar">


    <div class="menu-title">
        MENU UTAMA
    </div>


    <!-- DASHBOARD -->

    <a href="{{ route('admin.dashboard') }}">

        <span class="menu-icon">
            🏠
        </span>

        Dashboard

    </a>


    <!-- PRODUK -->

    <a href="{{ route('products.index') }}">

        <span class="menu-icon">
            📦
        </span>

        Produk

    </a>


    <!-- KATEGORI -->

    <a href="#">

        <span class="menu-icon">
            🏷️
        </span>

        Kategori

    </a>


    <!-- PESANAN -->

    <a href="#">

        <span class="menu-icon">
            🛒
        </span>

        Pesanan

    </a>


    <!-- USER -->

    <a href="#">

        <span class="menu-icon">
            👥
        </span>

        User

    </a>


    <div class="divider"></div>


    <div class="menu-title">
        ADMIN
    </div>


    <!-- KELOLA ADMIN -->

    <a href="#">

        <span class="menu-icon">
            👤
        </span>

        Kelola Admin

    </a>


    <!-- PENGATURAN -->

    <a
        href="{{ route('admin.settings') }}"
        class="active"
    >

        <span class="menu-icon">
            ⚙️
        </span>

        Pengaturan

    </a>


    <div class="divider"></div>


    <!-- LOGOUT -->

    <a href="#">

        <span class="menu-icon">
            🚪
        </span>

        Logout

    </a>

</div>



<!-- CONTENT -->

<div class="content">


    <div class="page-header">

        <h1>
            Pengaturan
        </h1>

        <p>
            Kelola pengaturan Toko Semen Jaya
        </p>

    </div>



    <!-- PENGATURAN TOKO -->

    <div class="card">

        <h2>
            ⚙️ Pengaturan Toko
        </h2>

        <p class="card-description">
            Atur informasi dasar toko Anda.
        </p>


        <div class="form-group">

            <label>
                Nama Toko
            </label>

            <input
                type="text"
                value="Toko Semen Jaya"
            >

        </div>


        <div class="form-group">

            <label>
                Alamat Toko
            </label>

            <input
                type="text"
                placeholder="Masukkan alamat toko"
            >

        </div>


        <div class="form-group">

            <label>
                Nomor Telepon
            </label>

            <input
                type="text"
                placeholder="Masukkan nomor telepon"
            >

        </div>


        <div class="form-group">

            <label>
                Email Toko
            </label>

            <input
                type="email"
                placeholder="Masukkan email toko"
            >

        </div>


        <button
            class="btn btn-primary"
            onclick="simpanPengaturan()"
        >
            💾 Simpan Pengaturan
        </button>

    </div>



    <!-- TAMPILAN -->

    <div class="card">

        <h2>
            🎨 Tampilan
        </h2>

        <p class="card-description">
            Atur tampilan halaman admin.
        </p>


        <div class="form-group">

            <label>
                Bahasa
            </label>

            <select>

                <option>
                    Bahasa Indonesia
                </option>

                <option>
                    English
                </option>

            </select>

        </div>


        <div class="form-group">

            <label>
                Tema
            </label>

            <select>

                <option>
                    Terang
                </option>

                <option>
                    Gelap
                </option>

            </select>

        </div>


        <button
            class="btn btn-primary"
            onclick="simpanTampilan()"
        >
            💾 Simpan Tampilan
        </button>

    </div>



    <!-- AKUN ADMIN -->

    <div class="card">

        <h2>
            👤 Akun Admin
        </h2>

        <p class="card-description">
            Pengaturan akun administrator.
        </p>


        <div class="form-group">

            <label>
                Nama Admin
            </label>

            <input
                type="text"
                value="Admin"
            >

        </div>


        <div class="form-group">

            <label>
                Email Admin
            </label>

            <input
                type="email"
                placeholder="admin@gmail.com"
            >

        </div>


        <button
            class="btn btn-primary"
            onclick="simpanAkun()"
        >
            💾 Simpan Akun
        </button>

    </div>

</div>



<script>

    function simpanPengaturan() {

        alert(
            'Pengaturan toko berhasil disimpan!'
        );

    }


    function simpanTampilan() {

        alert(
            'Pengaturan tampilan berhasil disimpan!'
        );

    }


    function simpanAkun() {

        alert(
            'Pengaturan akun berhasil disimpan!'
        );

    }

</script>


</body>

</html>