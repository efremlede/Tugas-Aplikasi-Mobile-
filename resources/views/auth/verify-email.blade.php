<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email - Toko Semen Jaya</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f6f9; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); text-align: center; max-width: 400px; }
        button { background-color: #0d6efd; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; margin-top: 15px; }
        button:hover { background-color: #0b5ed7; }
        .alert { color: green; font-weight: bold; margin-bottom: 15px; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Verifikasi Email Anda</h2>

        @if (session('message'))
            <div class="alert">
                {{ session('message') }}
            </div>
        @endif

        <p>Terima kasih telah mendaftar! Sebelum memulai, silakan periksa email Anda dan klik link verifikasi yang telah kami kirimkan.</p>
        <p>Jika Anda tidak menerima email tersebut, klik tombol di bawah untuk mengirim ulang.</p>

        <form method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit">Kirim Ulang Email Verifikasi</button>
        </form>
    </div>
</body>
</html>