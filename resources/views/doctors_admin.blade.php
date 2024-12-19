@extends('admin_layout')

@section('title', 'Doctors Admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Daftar Dokter</h1>
        <a href="{{ url('/tambah-dokter') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah
        </a>
    </div>

    <!-- Search Bar -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fas fa-search"></i>
                </span>
                <input type="text" 
                       id="searchDoctor" 
                       class="form-control" 
                       placeholder="Cari berdasarkan nama atau spesialisasi..."
                       onkeyup="filterDoctors()">
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Doctors List -->
    <div class="row" id="doctorList">
        @forelse($doctors as $doctor)
        <div class="col-md-6 mb-4" data-doctor-id="{{ $doctor['id'] }}">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <!-- Doctor Photo -->
                        <div class="me-3">
                            @if($doctor['photo'])
                                <img src="{{ asset($doctor['photo']) }}" 
                                    alt="Foto {{ $doctor['name'] }}" 
                                    class="rounded-circle"
                                    style="width: 100px; height: 100px; object-fit: cover;">
                            @else
                                <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center text-white"
                                    style="width: 100px; height: 100px;">
                                    <i class="fas fa-user-md fa-3x"></i>
                                </div>
                            @endif
                        </div>

                        <!-- Doctor Info -->
                        <div>
                            <h5 class="card-title">{{ $doctor['name'] }}</h5>
                            <p class="mb-1"><i class="fas fa-stethoscope me-2"></i>{{ $doctor['specialization'] }}</p>
                            <p class="mb-1"><i class="fas fa-phone me-2"></i>{{ $doctor['phone'] }}</p>
                            <p class="mb-1"><i class="fas fa-envelope me-2"></i>{{ $doctor['email'] }}</p>
                            <p class="mb-1"><i class="fas fa-venus-mars me-2"></i>{{ $doctor['gender'] }}</p>
                            <p class="mb-1"><i class="fas fa-map-marker-alt me-2"></i>{{ $doctor['address'] }}</p>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-end mt-3 border-top pt-3">
                        <button onclick="hapusDokter({{ $doctor['id'] }})" 
                                class="btn btn-danger btn-sm me-2">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                        <a href="{{ url('/edit-dokter/'.$doctor['id']) }}" 
                        class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info">
                Tidak ada data dokter.
            </div>
        </div>
    @endforelse
    </div>
</div>

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus dokter ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Hapus</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function filterDoctors() {
    const searchValue = document.getElementById('searchDoctor').value.toLowerCase();
    const cards = document.getElementsByClassName('col-md-6');
    
    Array.from(cards).forEach(card => {
        const name = card.querySelector('.card-title').textContent.toLowerCase();
        const specializationElement = card.querySelector('.fa-stethoscope').parentElement;
        const specialization = specializationElement.textContent.toLowerCase();
        
        if (name.includes(searchValue) || specialization.includes(searchValue)) {
            card.style.display = '';
        } else {
            card.style.display = 'none';
        }
    });
}

let doctorIdToDelete = null;
const confirmDeleteModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));

function hapusDokter(id) {
    doctorIdToDelete = id;
    confirmDeleteModal.show();
}

document.getElementById('confirmDelete').addEventListener('click', function() {
    if (doctorIdToDelete) {
        fetch(`/dokter/${doctorIdToDelete}`, { // Gunakan backticks
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            confirmDeleteModal.hide();
            if (data.success) {
                // Hapus card dokter dari tampilan
                const doctorCard = document.querySelector(`[data-doctor-id="${doctorIdToDelete}"]`);
                if (doctorCard) {
                    doctorCard.remove();
                }
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menghapus dokter');
        });
    }
});
</script>
@endpush
@endsection