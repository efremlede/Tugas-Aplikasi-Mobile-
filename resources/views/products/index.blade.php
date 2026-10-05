<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Produk - Toko Semen Jaya</title>


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


        /* =========================
           HEADER
        ========================= */

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


        /* =========================
           ADMIN
        ========================= */

        .admin-menu {
            position: relative;
        }


        .admin-button {
            background: transparent;

            border: none;

            color: white;

            font-size: 17px;

            cursor: pointer;

            padding: 10px 15px;
        }


        .admin-button:hover {
            opacity: 0.8;
        }


        .admin-dropdown {
            display: none;

            position: absolute;

            right: 0;

            top: 55px;

            width: 200px;

            background: white;

            border-radius: 8px;

            box-shadow: 0 5px 20px rgba(0,0,0,0.2);

            overflow: hidden;

            z-index: 2000;
        }


        .admin-dropdown.show {
            display: block;
        }


        .admin-dropdown a {
            display: block;

            padding: 14px 18px;

            color: #333;

            text-decoration: none;

            font-size: 15px;
        }


        .admin-dropdown a:hover {
            background: #f1f3f5;
        }


        /* =========================
           SIDEBAR
        ========================= */

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

            transition: 0.2s;
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

            font-size: 18px;
        }


        .divider {
            height: 1px;

            background: #465361;

            margin: 15px 20px;
        }


        /* =========================
           CONTENT
        ========================= */

        .content {
            margin-left: 250px;

            padding: 110px 45px 50px;
        }


        .page-header {
            display: flex;

            justify-content: space-between;

            align-items: center;

            margin-bottom: 30px;
        }


        .page-header h1 {
            font-size: 40px;

            margin-bottom: 5px;
        }


        .page-header p {
            font-size: 18px;

            color: #687385;
        }


        /* =========================
           BUTTON TAMBAH
        ========================= */

        .btn-tambah {
            display: inline-block;

            background: #1677f9;

            color: white;

            text-decoration: none;

            padding: 15px 22px;

            border-radius: 8px;

            font-size: 17px;

            font-weight: bold;
        }


        .btn-tambah:hover {
            background: #0d63d5;
        }


        /* =========================
           CARD
        ========================= */

        .card {
            background: white;

            border-radius: 8px;

            box-shadow: 0 2px 10px rgba(0,0,0,0.08);

            overflow: hidden;
        }


        .card-title {
            padding: 24px 25px;

            font-size: 22px;

            font-weight: bold;

            border-bottom: 1px solid #ddd;
        }


        /* =========================
           TABLE
        ========================= */

        .table-container {
            overflow-x: auto;
        }


        table {
            width: 100%;

            border-collapse: collapse;
        }


        th {
            background: #f8f9fa;

            text-align: left;

            padding: 17px 12px;

            font-size: 16px;

            border-bottom: 1px solid #ddd;
        }


        td {
            padding: 18px 12px;

            border-bottom: 1px solid #e5e7eb;

            vertical-align: middle;
        }


        .product-name {
            font-size: 17px;

            font-weight: bold;

            margin-bottom: 8px;
        }


        .description {
            color: #687385;

            line-height: 1.6;

            max-width: 430px;
        }


        /* =========================
           STATUS
        ========================= */

        .status {
            display: inline-block;

            padding: 6px 12px;

            border-radius: 8px;

            background: #6c757d;

            color: white;

            font-size: 13px;

            font-weight: bold;
        }


        .status.active {
            background: #198754;
        }


        /* =========================
           ACTION
        ========================= */

        .action {
            display: flex;

            gap: 8px;

            align-items: center;
        }


        .btn {
            border: none;

            padding: 10px 14px;

            border-radius: 6px;

            color: white;

            text-decoration: none;

            cursor: pointer;

            font-size: 14px;
        }


        .btn-detail {
            background: #0dcaf0;
        }


        .btn-edit {
            background: #ffc107;
        }


        .btn-hapus {
            background: #dc3545;
        }


        .btn:hover {
            opacity: 0.85;
        }

    </style>

</head>


<body>


<!-- =====================================================
     HEADER
===================================================== -->

<div class="header">

    <div class="logo">
        Toko Semen Jaya
    </div>


    <div class="admin-menu">

        <button
            class="admin-button"
            onclick="toggleAdminMenu()"
        >
            👤 <strong>Admin</strong> ▾
        </button>


        <div
            id="adminDropdown"
            class="admin-dropdown"
        >

            <a href="{{ route('admin.dashboard') }}">
                🏠 Dashboard
            </a>

            <a href="{{ route('admin.settings') }}">
                ⚙️ Pengaturan
            </a>

            <a href="#">
                👤 Profil Admin
            </a>

            <a href="#">
                🚪 Logout
            </a>

        </div>

    </div>

</div>



<!-- =====================================================
     SIDEBAR
===================================================== -->

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

    <a
        href="{{ route('products.index') }}"
        class="active"
    >

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

    <a href="{{ route('admin.settings') }}">

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



<!-- =====================================================
     CONTENT
===================================================== -->

<div class="content">


    <div class="page-header">

        <div>

            <h1>
                Products
            </h1>

            <p>
                Daftar produk
            </p>

        </div>


        <a
            href="{{ route('products.create') }}"
            class="btn-tambah"
        >
            + Tambah Product
        </a>

    </div>



    <div class="card">


        <div class="card-title">
            Data Product
        </div>


        <div class="table-container">

            <table>


                <thead>

                    <tr>

                        <th>No</th>

                        <th>Product</th>

                        <th>Kategori</th>

                        <th>Harga</th>

                        <th>Stock</th>

                        <th>Status</th>

                        <th>Aksi</th>

                    </tr>

                </thead>


                <tbody>


                    @forelse ($products as $product)

                    <tr>


                        <td>
                            {{ $loop->iteration }}
                        </td>


                        <td>

                            <div class="product-name">

                                {{ $product->name }}

                            </div>


                            <div class="description">

                                {{ $product->description }}

                            </div>

                        </td>


                        <td>

                            {{ $product->category }}

                        </td>


                        <td>

                            Rp {{ number_format($product->price, 0, ',', '.') }}

                        </td>


                        <td>

                            {{ $product->stock }}

                        </td>


                        <td>

                            @if(
                                $product->status == 'aktif' ||
                                $product->status == 'Aktif'
                            )

                                <span class="status active">
                                    Aktif
                                </span>

                            @else

                                <span class="status">
                                    Nonaktif
                                </span>

                            @endif

                        </td>


                        <td>

                            <div class="action">


                                <a
                                    href="{{ route('products.show', $product->id) }}"
                                    class="btn btn-detail"
                                >
                                    Detail
                                </a>


                                <a
                                    href="{{ route('products.edit', $product->id) }}"
                                    class="btn btn-edit"
                                >
                                    Edit
                                </a>


                                <form
                                    action="{{ route('products.destroy', $product->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus produk ini?');"
                                >

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-hapus"
                                    >
                                        Hapus
                                    </button>

                                </form>


                            </div>

                        </td>

                    </tr>


                    @empty

                    <tr>

                        <td
                            colspan="7"
                            style="text-align:center; padding:40px;"
                        >

                            Belum ada produk.

                        </td>

                    </tr>

                    @endforelse


                </tbody>

            </table>

        </div>

    </div>

</div>



<!-- =====================================================
     JAVASCRIPT
===================================================== -->

<script>

    function toggleAdminMenu() {

        const dropdown =
            document.getElementById('adminDropdown');

        dropdown.classList.toggle('show');

    }


    document.addEventListener('click', function(event) {

        const adminMenu =
            document.querySelector('.admin-menu');

        const dropdown =
            document.getElementById('adminDropdown');


        if (!adminMenu.contains(event.target)) {

            dropdown.classList.remove('show');

        }

    });

</script>


</body>

</html>