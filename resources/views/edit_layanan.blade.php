@extends('admin_layout')
@section('title', 'Edit Layanan')
@section('content')
<div class="container">
    <!-- Header section tetap sama -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Layanan</h1>
        <a href="{{ url('/layanan-admin') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <!-- Error alerts tetap sama -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Ambil data paket katering jika ada -->
    @php
        $paketKatering = null;
        if ($service['category'] === 'Paket Katering') {
            $paketKatering = DB::table('paket_katering')->where('id_layanan', $service['id'])->first();
        }
    @endphp

    <div class="card">
        <div class="card-body">
            <form action="{{ url('/layanan/'.$service['id']) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <!-- Kolom kiri - Informasi utama -->
                    <div class="col-md-8">
                        <!-- Form fields yang sudah ada -->
                        <div class="mb-3">
                            <label class="form-label">Nama Layanan</label>
                            <input type="text" class="form-control" name="name" value="{{ $service['name'] }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="description" rows="3" required>{{ $service['description'] }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Harga</label>
                            <input type="number" class="form-control" name="price" value="{{ $service['price'] }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <select class="form-select" name="category" id="category" required>
                                <option value="">Pilih Kategori</option>
                                <option value="Dokter Panggilan" {{ $service['category'] == 'Dokter Panggilan' ? 'selected' : '' }}>
                                    Dokter Panggilan
                                </option>
                                <option value="Paket Katering" {{ $service['category'] == 'Paket Katering' ? 'selected' : '' }}>
                                    Paket Katering
                                </option>
                            </select>
                        </div>

                        <!-- Field untuk Paket Katering -->
                        <div id="paketKateringFields" style="display: {{ $service['category'] === 'Paket Katering' ? 'block' : 'none' }}">
                            <hr>
                            <h4>Detail Paket Katering</h4>
                            
                            <div class="mb-3">
                                <label class="form-label">Nama Paket</label>
                                <input type="text" class="form-control" name="paket_nama" 
                                       value="{{ $paketKatering ? $paketKatering->nama : '' }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Detail Menu</label>
                                <textarea class="form-control" name="detail_menu" rows="3">{{ $paketKatering ? $paketKatering->detail_menu : '' }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Durasi (hari)</label>
                                <input type="number" class="form-control" name="durasi" 
                                       value="{{ $paketKatering ? $paketKatering->durasi : '' }}">
                            </div>
                        </div>
                    </div>

                    <!-- Kolom kanan - Upload gambar -->
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Gambar Saat Ini</label>
                            @if($service['image'])
                                <img src="{{ asset($service['image']) }}" class="img-thumbnail d-block mb-2" alt="Current Image">
                            @else
                                <div class="alert alert-info">Tidak ada gambar</div>
                            @endif
                            
                            <label class="form-label">Upload Gambar Baru</label>
                            <input type="file" class="form-control" name="image" accept="image/*">
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.getElementById('category').addEventListener('change', function() {
    const paketFields = document.getElementById('paketKateringFields');
    if (this.value === 'Paket Katering') {
        paketFields.style.display = 'block';
    } else {
        paketFields.style.display = 'none';
    }
});
</script>
@endpush
@endsection