@extends('layout')

@section('title', 'Login')

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="height: 80vh;">
        <div class="text-center">
            <h3>Masuk</h3>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <p>Selamat datang di Atma Hospital! Silahkan masukkan nomor telepon Anda untuk melanjutkan</p>
            <form action="/check-phone" method="POST">
                @csrf
                <div class="mb-3">
                    <div class="input-group">
                        <input type="text" name="phone" class="form-control" placeholder="Masukan Nomor Telepon" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Lanjutkan</button>
            </form>

            <hr>
            <p>Belum punya akun?</p>
            {{-- Button Register --}}
            <a href="{{ url('/register') }}" class="btn btn-secondary">Daftar</a>
        </div>
    </div>
@endsection
