@extends('layout')

@section('title', 'Registrasi')

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="height: 80vh;">
        <div class="text-center">
            <h3>Registrasi</h3>

            {{-- Tampilkan error jika ada --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form registrasi --}}
            <form action="/proses-register" method="POST">
                @csrf

                {{-- Input nomor telepon --}}
                <div class="mb-3">
                    <input type="text" name="phone" class="form-control" placeholder="Nomor Telepon" required>
                </div>

                {{-- Input email --}}
                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>

                {{-- Input username --}}
                <div class="mb-3">
                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                </div>

                {{-- Input kata sandi --}}
                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Kata Sandi" required>
                </div>

                {{-- Konfirmasi kata sandi --}}
                <div class="mb-3">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Kata Sandi" required>
                </div>

                {{-- Tombol daftar --}}
                <button type="submit" class="btn btn-primary">Daftar</button>
            </form>
        </div>
    </div>
@endsection
