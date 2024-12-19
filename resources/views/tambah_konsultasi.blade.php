@extends('dashboard_konsultasi')

@section('title', 'Tambah Konsultasi')

@section('content')
<div class="container">
    <a href="{{ route('konsultasi') }}" class="text-decoration-none">
        ← Kembali
    </a>

    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">Tambahkan Data Konsultasi</h5>

            <!-- Tambahkan error messages -->
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('konsultasi.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label">Jenis Konsultasi</label>
                    <select name="jenis_konsultasi" class="form-select" required>
                        <option value="Terjadwal">Terjadwal (Dengan Pesanan)</option>
                        <option value="Darurat">Darurat (Tanpa Pesanan)</option>
                    </select>
                </div>

                <div class="mb-3 pesanan-field">
                    <label class="form-label">Pesanan</label>
                    <select name="pesanan" class="form-select">
                        <option value="">Pilih Pesanan</option>
                        @foreach($pesanan as $p)
                            <option value="{{ $p->id }}"
                                    data-dokter="{{ $p->id_dokter }}"
                                    data-pasien="{{ $p->id_pengguna }}">
                                Pesanan #{{ $p->id }} - {{ date('d/m/Y', strtotime($p->tanggal_pesanan)) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Dokter</label>
                    <select name="dokter" class="form-select" required>
                        <option value="">Pilih Dokter</option>
                        @foreach($dokter as $d)
                            <option value="{{ $d->id }}">{{ $d->pengguna->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pasien</label>
                    <select name="pasien" class="form-select" required>
                        <option value="">Pilih Pasien</option>
                        @foreach($pasien as $p)
                            <option value="{{ $p->id }}">{{ $p->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Keluhan</label>
                    <textarea name="keluhan" class="form-control" rows="3" required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Diagnosa</label>
                    <textarea name="diagnosa" class="form-control" rows="3" required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Catatan</label>
                    <textarea name="catatan" class="form-control" rows="3"></textarea>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Konfirmasi Konsultasi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Handle jenis konsultasi change
document.querySelector('[name="jenis_konsultasi"]').addEventListener('change', function() {
    const pesananField = document.querySelector('.pesanan-field');
    const pesananSelect = document.querySelector('[name="pesanan"]');
    
    if (this.value === 'Darurat') {
        pesananField.style.display = 'none';
        pesananSelect.value = '';  // Reset pesanan selection
        pesananSelect.removeAttribute('required');
        
        // Reset dokter dan pasien karena tidak ada pesanan yang dipilih
        document.querySelector('select[name="dokter"]').value = '';
        document.querySelector('select[name="pasien"]').value = '';
    } else {
        pesananField.style.display = 'block';
        pesananSelect.setAttribute('required', 'required');
    }
});

// Handle pesanan change
document.querySelector('select[name="pesanan"]').addEventListener('change', function() {
    if (this.value) {  // Hanya auto-fill jika ada pesanan yang dipilih
        const selectedOption = this.options[this.selectedIndex];
        const dokterId = selectedOption.dataset.dokter;
        const pasienId = selectedOption.dataset.pasien;
       
        document.querySelector('select[name="dokter"]').value = dokterId;
        document.querySelector('select[name="pasien"]').value = pasienId;
    }
});
</script>
@endsection