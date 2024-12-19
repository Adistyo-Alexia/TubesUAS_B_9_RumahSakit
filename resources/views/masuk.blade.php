@extends('layout')

@section('title', 'Masuk')

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="height: 80vh;">
        <div class="text-center">
            <h3>Masukkan Kata Sandi</h3>
            <p>Nomor Telepon: {{ session('phone') }}</p>
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <form action="/proses-login" method="POST">
                @csrf
                <input type="hidden" name="phone" value="{{ session('phone') }}">
                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Masukkan Kata Sandi" required>
                </div>
                <button type="submit" class="btn btn-primary">Masuk</button>
            </form>
        </div>
    </div>
@endsection