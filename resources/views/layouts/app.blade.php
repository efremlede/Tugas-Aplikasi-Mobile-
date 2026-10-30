<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ config('app.name', 'Toko Semen Jaya') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    @vite(['resources/js/app.js'])

    <style>
        body {
            background-color: #f5f5f5;
        }

        .navbar-brand {
            font-weight: bold;
        }

        .content {
            padding: 30px 0;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">
                Toko Semen Jaya
            </a>

            <div class="d-flex align-items-center gap-2">
                <a href="/products" class="btn btn-outline-light">
                    Produk
                </a>

                @auth
                    <span class="text-white me-2">Welcome, {{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
                    </form>
                @endauth

                @guest
                    <a href="{{ route('login') }}" class="btn btn-light btn-sm">Login</a>
                @endguest
            </div>
        </div>
    </nav>

    <div class="container content">
        @yield('content')
    </div>

    <!-- Skrip Listener Laravel Echo & Reverb yang Ditambahkan -->
    <script>
        window.Echo.private('user.{{ auth()->id() }}')
            .listen('OrderPlaced', (e) => {
                alert(`Order #${e.order_id} telah ditempatkan! Total: Rp ${e.total}`);
                console.log('Order Placed:', e);
            });
    </script>
</body>
</html>