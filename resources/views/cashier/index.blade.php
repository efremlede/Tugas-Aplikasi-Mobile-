@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="h4">Kasir Toko Semen Jaya</h1>
                <p class="mb-3">Selamat datang, {{ auth()->user()->name }}. Anda berhasil masuk sebagai kasir.</p>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">Keluar</button>
                </form>
            </div>
        </div>
    </div>
@endsection
