@extends('dashboard_konsultasi')

@section('title', 'Daftar Konsultasi')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Daftar Konsultasi</h1>
        <a href="{{ route('tambah.konsultasi') }}" class="btn btn-primary px-4">
            <i class="fas fa-plus me-2"></i>Tambah Konsultasi
        </a>
    </div>

    <div class="row g-4">
        @forelse($konsultasi as $k)
            <div class="col-md-6">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <span class="badge bg-primary">{{ $k->status }}</span>
                            @if($k->id_pesanan)
                                <span class="badge bg-info ms-2">Terjadwal</span>
                                <small class="text-muted d-block mt-1">Pesanan #{{ $k->id_pesanan }}</small>
                            @else
                                <span class="badge bg-warning ms-2">Darurat</span>
                            @endif
                        </div>
                            <span class="badge bg-primary">{{ $k->status }}</span>
                            <span class="text-muted">{{ date('d/m/Y', strtotime($k->tanggal_konsultasi)) }}</span>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="text-muted mb-1">Dokter</h6>
                                    <p class="mb-3">{{ $k->dokter->pengguna->nama }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-muted mb-1">Pasien</h6>
                                    <p class="mb-3">{{ $k->pasien->nama }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <h6 class="text-muted mb-1">Keluhan</h6>
                            <p class="mb-3">{{ $k->keluhan }}</p>

                            <h6 class="text-muted mb-1">Diagnosa</h6>
                            <p class="mb-3">{{ $k->diagnosa }}</p>

                            @if($k->catatan)
                                <h6 class="text-muted mb-1">Catatan</h6>
                                <p class="mb-0">{{ $k->catatan }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="card-footer bg-transparent border-top-0">
                        <div class="d-flex justify-content-end gap-2">
                            @if(!$k->resep)
                                <a href="{{ route('resep.create', ['konsultasi_id' => $k->id]) }}" 
                                   class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus me-1"></i> Resep
                                </a>
                            @else
                                <a href="{{ route('resep.show', $k->resep->id) }}" 
                                   class="btn btn-info btn-sm">
                                    <i class="fas fa-eye me-1"></i> Lihat Resep
                                </a>
                            @endif
                            <a href="{{ route('konsultasi.edit', $k->id) }}" 
                               class="btn btn-warning btn-sm">
                                <i class="fas fa-edit me-1"></i> Edit
                            </a>
                            <button type="button" class="btn btn-danger btn-sm" 
                                    onclick="confirmDelete({{ $k->id }})">
                                <i class="fas fa-trash me-1"></i> Hapus
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    Tidak ada data konsultasi
                </div>
            </div>
        @endforelse
    </div>
</div>

<!-- Modal konfirmasi hapus tetap sama -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus konsultasi ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border: none;
        border-radius: 10px;
        transition: transform 0.2s;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .badge {
        font-weight: 500;
        padding: 6px 12px;
        border-radius: 6px;
    }

    .btn {
        border-radius: 6px;
        padding: 0.4rem 0.8rem;
    }

    .text-muted {
        font-size: 0.9rem;
    }

    h6.text-muted {
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
</style>

<script>
    function confirmDelete(id) {
        const modal = document.getElementById('deleteModal');
        const form = document.getElementById('deleteForm');
        form.action = `/konsultasi/${id}`;
        new bootstrap.Modal(modal).show();
    }
</script>
@endsection