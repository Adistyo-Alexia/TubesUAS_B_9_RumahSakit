@extends('admin_layout')

@section('title', 'Layanan Admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Daftar Layanan</h1>
        <a href="{{ url('/tambah-layanan') }}" class="btn btn-primary">
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
                <input type="text" id="searchService" class="form-control" placeholder="Cari berdasarkan nama atau kategori..." onkeyup="filterServices()">
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

    <!-- Services List -->
    <div class="row" id="serviceList">
        @forelse($services as $service)
            <div class="col-md-6 mb-4" data-service-id="{{ $service['id'] }}">
                <div class="card">
                    @if($service['image'])
                        <img src="{{ asset($service['image']) }}" class="card-img-top" 
                             alt="{{ $service['name'] }}" style="height: 200px; object-fit: cover;">
                    @else
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" 
                             style="height: 200px;">
                            <i class="fas fa-image fa-3x text-muted"></i>
                        </div>
                    @endif
                    
                    <div class="card-body">
                        <h5 class="card-title">{{ $service['name'] }}</h5>
                        <p class="card-text mb-1">
                            <i class="fas fa-tag me-2"></i>
                            {{ number_format($service['price'], 0, ',', '.') }}
                        </p>
                        <p class="card-text mb-1">
                            <i class="fas fa-list-alt me-2"></i>
                            {{ $service['category'] }}
                        </p>
                        <p class="card-text">
                            <small>{{ $service['description'] }}</small>
                        </p>

                        <div class="d-flex justify-content-end mt-3 pt-3 border-top">
                            <button class="btn btn-danger btn-sm me-2" 
                                    onclick="hapusLayanan({{ $service['id'] }})">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                            <a href="{{ url('/edit-layanan/'.$service['id']) }}" 
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
                    Tidak ada data layanan.
                </div>
            </div>
        @endforelse
    </div>
</div>

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus layanan ini?
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
    function filterServices() {
        const searchValue = document.getElementById('searchService').value.toLowerCase().trim();
        const cards = document.getElementsByClassName('col-md-6');
        
        Array.from(cards).forEach(card => {
            if (!card.querySelector('.card-title')) return; // Skip jika tidak ada card-title

            const title = card.querySelector('.card-title').textContent.toLowerCase().trim();
            const categoryElement = card.querySelector('.fa-list-alt');
            const category = categoryElement ? categoryElement.parentNode.textContent.toLowerCase().trim() : '';
            
            // Debugging Logs (Optional)
            // console.log('Searching for:', searchValue);
            // console.log('Title:', title);
            // console.log('Category:', category);
            
            if (title.includes(searchValue) || category.includes(searchValue)) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    }

    let serviceIdToDelete = null;
    const confirmDeleteModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));

    function hapusLayanan(id) {
        serviceIdToDelete = id;
        confirmDeleteModal.show();
    }

    document.getElementById('confirmDelete').addEventListener('click', function() {
        if (serviceIdToDelete) {
            fetch(`/layanan/${serviceIdToDelete}`, { // Gunakan backticks jika perlu
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                confirmDeleteModal.hide();
                if (data.success) {
                    // Hapus card layanan dari tampilan
                    const serviceCard = document.querySelector(`[data-service-id="${serviceIdToDelete}"]`);
                    if (serviceCard) {
                        serviceCard.remove();
                    }
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menghapus layanan');
            });
        }
    });
</script>
@endpush
@endsection
