<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Semen Jaya</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            color: #333;
        }

        /* NAVBAR */
        .navbar {
            background: #d62828;
            color: white;
            padding: 20px 8%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
        }

        .nav-menu {
            display: flex;
            gap: 30px;
            align-items: center;
        }

        .nav-menu a {
            color: white;
            text-decoration: none;
            font-size: 18px;
        }

        .nav-menu a:hover {
            text-decoration: underline;
        }

        .login-btn {
            border: 2px solid white;
            padding: 8px 15px;
            border-radius: 5px;
        }

        /* HERO */
        .hero {
            background: linear-gradient(
                rgba(0,0,0,0.5),
                rgba(0,0,0,0.5)
            ),
            url('https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&w=1600&q=80');

            background-size: cover;
            background-position: center;

            min-height: 500px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            padding: 40px 20px;
        }

        .hero h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 22px;
            margin-bottom: 30px;
        }

        .btn {
            display: inline-block;
            background: #d62828;
            color: white;
            padding: 14px 28px;
            text-decoration: none;
            border-radius: 6px;
            font-size: 18px;
        }

        .btn:hover {
            background: #b71c1c;
        }

        /* PRODUK */
        .section {
            padding: 60px 8%;
            text-align: center;
        }

        .section h2 {
            font-size: 36px;
            margin-bottom: 15px;
        }

        .section-subtitle {
            color: #666;
            margin-bottom: 40px;
            font-size: 18px;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .product-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            text-align: left;
        }

        .product-image {
            height: 220px;
            background: #eee;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #888;
            font-size: 20px;
        }

        .product-content {
            padding: 25px;
        }

        .product-content h3 {
            font-size: 23px;
            margin-bottom: 12px;
        }

        .product-content p {
            margin-bottom: 8px;
            color: #666;
        }

        .price {
            color: #d62828;
            font-size: 21px;
            font-weight: bold;
            margin: 15px 0;
        }

        /* KEUNGGULAN */
        .advantages {
            background: white;
        }

        .advantage-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-top: 35px;
        }

        .advantage-card {
            padding: 30px 20px;
            border-radius: 10px;
            background: #f8f8f8;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
        }

        .advantage-card h3 {
            color: #d62828;
            margin-bottom: 15px;
        }

        .advantage-card p {
            color: #666;
            line-height: 1.6;
        }

        /* TENTANG */
        .about {
            background: #f5f5f5;
        }

        .about p {
            max-width: 800px;
            margin: auto;
            line-height: 1.8;
            color: #555;
            font-size: 18px;
        }

        /* KONTAK */
        .contact {
            background: white;
        }

        .contact p {
            margin: 10px;
            font-size: 18px;
        }

        /* FOOTER */
        footer {
            background: #222;
            color: white;
            text-align: center;
            padding: 25px;
        }

        @media (max-width: 900px) {
            .product-grid {
                grid-template-columns: 1fr;
            }

            .advantage-grid {
                grid-template-columns: 1fr 1fr;
            }

            .navbar {
                flex-direction: column;
                gap: 20px;
            }

            .nav-menu {
                flex-wrap: wrap;
                justify-content: center;
            }

            .hero h1 {
                font-size: 35px;
            }
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="logo">
            Toko Semen Jaya
        </div>

        <div class="nav-menu">
            <a href="/">Home</a>

            <a href="/products">Produk</a>

            <a href="#tentang">Tentang Kami</a>

            <a href="#kontak">Kontak</a>

            <!-- TOMBOL LOGIN -->
            <a href="/login" class="login-btn">Login</a>
        </div>
    </nav>


    <!-- HERO -->
    <section class="hero">
        <div>
            <h1>Semen Berkualitas untuk Bangunan Anda</h1>

            <p>
                Menyediakan semen berkualitas dengan harga terjangkau
                untuk kebutuhan pembangunan Anda.
            </p>

            <a href="/products" class="btn">
                Belanja Sekarang
            </a>
        </div>
    </section>


    <!-- PRODUK UNGGULAN -->
    <section class="section">
        <h2>Produk Semen Unggulan</h2>

        <p class="section-subtitle">
            Pilih produk semen berkualitas untuk kebutuhan bangunan Anda
        </p>

        <div class="product-grid">

            <div class="product-card">
                <div class="product-image">
                    Foto Semen
                </div>

                <div class="product-content">
                    <h3>Semen Kupang 40 kg</h3>
                    <p>Merek: Semen Kupang</p>
                    <p>Berat: 40 kg</p>
                    <div class="price">Rp 65.000</div>

                    <a href="/products" class="btn">
                        Lihat Produk
                    </a>
                </div>
            </div>


            <div class="product-card">
                <div class="product-image">
                    Foto Semen
                </div>

                <div class="product-content">
                    <h3>Semen Kupang 50 kg</h3>
                    <p>Merek: Semen Kupang</p>
                    <p>Berat: 50 kg</p>
                    <div class="price">Rp 75.000</div>

                    <a href="/products" class="btn">
                        Lihat Produk
                    </a>
                </div>
            </div>


            <div class="product-card">
                <div class="product-image">
                    Foto Semen
                </div>

                <div class="product-content">
                    <h3>Semen Tiga Roda 40 kg</h3>
                    <p>Merek: Tiga Roda</p>
                    <p>Berat: 40 kg</p>
                    <div class="price">Rp 70.000</div>

                    <a href="/products" class="btn">
                        Lihat Produk
                    </a>
                </div>
            </div>

        </div>
    </section>


    <!-- KEUNGGULAN -->
    <section class="section advantages">

        <h2>Keunggulan Toko Kami</h2>

        <p class="section-subtitle">
            Mengapa memilih Toko Semen Jaya?
        </p>

        <div class="advantage-grid">

            <div class="advantage-card">
                <h3>Harga Terjangkau</h3>
                <p>
                    Kami menyediakan harga semen yang terjangkau
                    untuk kebutuhan pembangunan Anda.
                </p>
            </div>


            <div class="advantage-card">
                <h3>Produk Berkualitas</h3>
                <p>
                    Menyediakan berbagai produk semen berkualitas
                    untuk bangunan Anda.
                </p>
            </div>


            <div class="advantage-card">
                <h3>Pengiriman Cepat</h3>
                <p>
                    Pesanan diproses dan dikirim dengan cepat
                    sampai ke tempat Anda.
                </p>
            </div>


            <div class="advantage-card">
                <h3>Pelayanan Terpercaya</h3>
                <p>
                    Memberikan pelayanan terbaik kepada pelanggan
                    Toko Semen Jaya.
                </p>
            </div>

        </div>
    </section>


    <!-- TENTANG KAMI -->
    <section class="section about" id="tentang">

        <h2>Tentang Kami</h2>

        <p>
            Toko Semen Jaya merupakan toko yang menyediakan berbagai
            macam semen dan bahan bangunan berkualitas. Kami berkomitmen
            memberikan produk berkualitas, harga terjangkau dan pelayanan
            terbaik kepada pelanggan.
        </p>

    </section>


    <!-- KONTAK -->
    <section class="section contact" id="kontak">

        <h2>Kontak Kami</h2>

        <p>📞 Telepon: 0812-3456-7890</p>

        <p>📧 Email: tokosemenjaya@gmail.com</p>

        <p>📍 Alamat: Kota Kupang, Nusa Tenggara Timur</p>

    </section>


    <!-- FOOTER -->
    <footer>

        <p>
            © 2026 Toko Semen Jaya. Semua Hak Dilindungi.
        </p>

    </footer>

</body>
</html>