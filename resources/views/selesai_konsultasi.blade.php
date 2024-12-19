@extends('dashboard_konsultasi')

@section('title', 'Selesai Konsultasi')

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="height: 80vh;">
        <div class="text-center">
            <!-- Menampilkan ikon centang besar di tengah -->
            <img src="{{ asset('image/check-icon.png') }}" alt="Success" style="width: 300px; height: 300px;">
            <h3 class="mt-4">Data Konsultasi Berhasil Ditambah!</h3>
            <a href="/" class="btn btn-primary mt-3">Kembali ke Halaman Konsultasi</a>
        </div>
    </div>
@endsection
