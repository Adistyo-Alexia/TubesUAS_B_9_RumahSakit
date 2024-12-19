@extends('admin_layout')

@section('title', 'Edit Dokter')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Dokter</h1>
        <a href="{{ url('/doctors-admin') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url('/dokter/'.$doctor['id']) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="row mb-3">
            <div class="col-md-2">
                <label class="form-label">Foto Profil</label>
                @if($doctor['photo'])
                    <img src="{{ asset($doctor['photo']) }}" class="img-thumbnail mb-2" style="width: 150px;">
                @endif
                <input type="file" class="form-control" name="photo">
            </div>
            <div class="col-md-10">
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control" name="name" value="{{ $doctor['name'] }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Spesialisasi</label>
                    <input type="text" class="form-control" name="specialization" value="{{ $doctor['specialization'] }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea class="form-control" name="description" rows="3">{{ $doctor['description'] }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">No. Telepon</label>
                    <input type="text" class="form-control" name="phone" value="{{ $doctor['phone'] }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ $doctor['email'] }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jenis Kelamin</label>
                    <select class="form-select" name="gender" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="Laki-laki" {{ $doctor['gender'] == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ $doctor['gender'] == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <input type="text" class="form-control" name="address" value="{{ $doctor['address'] }}" required>
                </div>
            </div>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection