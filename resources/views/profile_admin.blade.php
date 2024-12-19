{{-- resources/views/profile_admin.blade.php --}}
@extends('admin_layout')

@section('title', 'Admin Profile')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body text-center">
                    <!-- Icon atau Foto Admin -->
                    <div class="mb-3">
                        <img src="{{ asset('image/doctor.png') }}" 
                             alt="Admin Photo" 
                             class="rounded-circle"
                             style="width: 150px; height: 150px; object-fit: cover;">
                    </div>

                    <!-- Informasi Admin -->
                    <h3 class="mb-3">Admin Atma</h3>
                    <p class="text-muted mb-4">Administrator</p>

                    <!-- Informasi Kontak -->
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-envelope me-3"></i>
                                <span>admin@atmahospital.com</span>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-phone me-3"></i>
                                <span>082233344455</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection