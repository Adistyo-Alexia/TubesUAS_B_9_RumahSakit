@extends('admin_layout')

@section('title', 'Tambah Dokter')

@section('content')
<div class="container">
    <h1>Tambah Dokter</h1>
    <a href="{{ url('/doctors-admin') }}" class="btn btn-secondary mb-3">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url('/dokter') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <label for="name" class="col-sm-2 col-form-label">Nama:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
        </div>
        
        <div class="row mb-3">
            <label for="specialization" class="col-sm-2 col-form-label">Spesialisasi:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="specialization" name="specialization" required>
            </div>
        </div>

        <!-- Tambahkan field Deskripsi -->
        <div class="row mb-3">
            <label for="description" class="col-sm-2 col-form-label">Deskripsi:</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
        </div>

        <div class="row mb-3">
            <label for="phone" class="col-sm-2 col-form-label">No. Telepon:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="email" class="col-sm-2 col-form-label">Email:</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="gender" class="col-sm-2 col-form-label">Jenis Kelamin:</label>
            <div class="col-sm-10">
                <select class="form-select" id="gender" name="gender" required>
                    <option value="" disabled selected>Pilih Jenis Kelamin</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <label for="address" class="col-sm-2 col-form-label">Alamat:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="photo" class="col-sm-2 col-form-label">Foto:</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
            </div>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-primary">Tambah Dokter</button>
        </div>
    </form>
</div>
@endsection