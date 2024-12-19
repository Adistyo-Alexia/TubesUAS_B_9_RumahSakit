@extends('dashboard_konsultasi')

@section('title', 'Edit Konsultasi')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Edit Konsultasi</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('konsultasi.update', $konsultasi->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label>Dokter</label>
                    <select name="dokter" class="form-select" required>
                        <option value="">Pilih Dokter</option>
                        @foreach($dokter as $d)
                            <option value="{{ $d->id }}" 
                                {{ $konsultasi->id_dokter == $d->id ? 'selected' : '' }}>
                                {{ $d->pengguna->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Pasien</label>
                    <select name="pasien" class="form-select" required>
                        <option value="">Pilih Pasien</option>
                        @foreach($pasien as $p)
                            <option value="{{ $p->id }}"
                                {{ $konsultasi->id_pasien == $p->id ? 'selected' : '' }}>
                                {{ $p->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" 
                           value="{{ $konsultasi->tanggal_konsultasi }}" required>
                </div>

                <div class="mb-3">
                    <label>Keluhan</label>
                    <textarea name="keluhan" class="form-control" rows="3" required>{{ $konsultasi->keluhan }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Diagnosa</label>
                    <textarea name="diagnosa" class="form-control" rows="3" required>{{ $konsultasi->diagnosa }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Catatan</label>
                    <textarea name="catatan" class="form-control" rows="3">{{ $konsultasi->catatan }}</textarea>
                </div>

                <div class="text-end">
                    <a href="{{ route('konsultasi') }}" class="btn btn-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection