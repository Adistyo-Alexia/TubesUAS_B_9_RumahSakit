@extends('admin_layout')

@section('title', 'Tambah Layanan')

@section('content')
<div class="container">
   <div class="d-flex justify-content-between align-items-center mb-4">
       <h1>Tambah Layanan</h1>
       <a href="{{ url('/layanan-admin') }}" class="btn btn-secondary">
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

   <div class="card">
       <div class="card-body">
           <form action="{{ url('/layanan') }}" method="POST" enctype="multipart/form-data">
               @csrf
               
               <div class="row">
                   <div class="col-md-8">
                       <div class="mb-3">
                           <label class="form-label">Nama Layanan</label>
                           <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                       </div>

                       <div class="mb-3">
                           <label class="form-label">Deskripsi</label>
                           <textarea class="form-control" name="description" rows="3" required>{{ old('description') }}</textarea>
                       </div>

                       <div class="mb-3">
                           <label class="form-label">Harga</label>
                           <input type="number" class="form-control" name="price" value="{{ old('price') }}" required>
                       </div>

                       <div class="mb-3">
                           <label class="form-label">Kategori</label>
                           <select class="form-select" name="category" id="category" required>
                               <option value="">Pilih Kategori</option>
                               <option value="Dokter Panggilan" {{ old('category') == 'Dokter Panggilan' ? 'selected' : '' }}>
                                   Dokter Panggilan
                               </option>
                               <option value="Paket Katering" {{ old('category') == 'Paket Katering' ? 'selected' : '' }}>
                                   Paket Katering
                               </option>
                           </select>
                       </div>

                       <!-- Paket Katering fields -->
                       <div class="paket-katering-fields" style="display: {{ old('category') == 'Paket Katering' ? 'block' : 'none' }}">
                           <hr>
                           <h4>Detail Paket Katering</h4>
                           
                           <div class="mb-3">
                               <label class="form-label">Nama Paket</label>
                               <input type="text" class="form-control" name="paket_nama" value="{{ old('paket_nama') }}">
                           </div>

                           <div class="mb-3">
                               <label class="form-label">Detail Menu</label>
                               <textarea class="form-control" name="detail_menu" rows="3">{{ old('detail_menu') }}</textarea>
                           </div>

                           <div class="mb-3">
                               <label class="form-label">Durasi (hari)</label>
                               <input type="number" class="form-control" name="durasi" value="{{ old('durasi') }}">
                           </div>
                       </div>
                   </div>

                   <div class="col-md-4">
                       <div class="mb-3">
                           <label class="form-label">Gambar</label>
                           <input type="file" class="form-control" name="image" accept="image/*">
                       </div>
                   </div>
               </div>

               <div class="text-end">
                   <button type="submit" class="btn btn-primary">
                       <i class="fas fa-save"></i> Simpan
                   </button>
               </div>
           </form>
       </div>
   </div>
</div>

@push('scripts')
<script>
   document.getElementById('category').addEventListener('change', function() {
       const paketFields = document.querySelector('.paket-katering-fields');
       if (this.value === 'Paket Katering') {
           paketFields.style.display = 'block';
       } else {
           paketFields.style.display = 'none';
       }
   });
</script>
@endpush
@endsection