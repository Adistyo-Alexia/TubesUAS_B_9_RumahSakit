@extends('dashboard_konsultasi')

@section('title', 'Tambah Resep')

@section('content')
<div class="container">
    <a href="{{ route('konsultasi') }}" class="text-decoration-none">
        ← Kembali
    </a>

    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">Tambahkan Data Resep</h5>

            <form action="{{ route('resep.store') }}" method="POST">
                @csrf
                <input type="hidden" name="konsultasi_id" value="{{ $konsultasi_id }}">
                
                <div class="mb-3">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Jumlah Obat</label>
                    <select name="jumlah_obat" id="jumlah_obat" class="form-select" required>
                        <option value="">Pilih Jumlah Obat</option>
                        @for($i = 1; $i <= 6; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <div id="daftar_obat">
                    <!-- Daftar obat akan ditambahkan di sini -->
                </div>

                <div class="mb-3">
                    <label>Catatan</label>
                    <textarea name="catatan" class="form-control" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Konfirmasi Resep</button>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('jumlah_obat').addEventListener('change', function() {
    const jumlah = parseInt(this.value);
    const container = document.getElementById('daftar_obat');
    container.innerHTML = '';
    
    for(let i = 1; i <= jumlah; i++) {
        const div = document.createElement('div');
        div.className = 'row mb-3';
        div.innerHTML = `
            <div class="col-md-6">
                <label>${i}# Nama Obat</label>
                <input type="text" name="nama_obat_${i}" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Dosis Obat</label>
                <input type="text" name="dosis_obat_${i}" class="form-control" required>
            </div>
        `;
        container.appendChild(div);
    }
});
</script>
@endsection