@extends('admin_layout')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container">
    <!-- Bagian Header -->
    <div class="row mb-2">
        <div class="col-md-12">
            <h1 style="font-weight: 900;">Selamat Datang, Admin!</h1>
        </div>
    </div>

    <!-- Pencarian User -->
    <div class="row mb-4">
        <div class="col-md-12">
            <input type="text" id="searchUser" class="form-control" placeholder="Cari User" value="{{ request('search') }}" onkeyup="filterUsers()">
        </div>
    </div>

    <!-- Daftar User -->
    <div class="row" id="userList">
        @forelse($users as $user)
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body d-flex align-items-center">
                        <!-- Foto User -->
                        <div class="me-4">
                            @if($user['photo'])
                                <img src="{{ asset($user['photo']) }}" alt="Foto {{ $user['name'] }}" class="img-thumbnail" style="width: 120px; height: 120px; object-fit: cover;">
                            @else
                                <img src="{{ asset('images/default-user.png') }}" alt="Unknown User" class="img-thumbnail" style="width: 120px; height: 120px; object-fit: cover;">
                            @endif
                        </div>
                        <!-- Informasi User -->
                        <div>
                            <h5 class="card-title" style="font-weight: 700;">Nama: {{ $user['name'] }}</h5>
                            <p class="card-text"><strong>No Telepon:</strong> {{ $user['phone'] }}</p>
                            <p class="card-text"><strong>Tgl Lahir:</strong> {{ $user['birthdate'] ? date('d-m-Y', strtotime($user['birthdate'])) : '-' }}</p>
                            <p class="card-text"><strong>Jenis Kelamin:</strong> {{ $user['gender'] ?? '-' }}</p>
                            <p class="card-text"><strong>Alamat:</strong> {{ $user['address'] ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p>Tidak ada data pengguna.</p>
            </div>
        @endforelse
    </div>
</div>

<script>
    function filterUsers() {
        let input = document.getElementById('searchUser').value.toLowerCase();
        let userCards = document.getElementById('userList').getElementsByClassName('col-md-6');
        
        for (let i = 0; i < userCards.length; i++) {
            let cardTitle = userCards[i].getElementsByClassName('card-title')[0];
            if (cardTitle) {
                let userName = cardTitle.innerText.toLowerCase();
                if (userName.indexOf(input) > -1) {
                    userCards[i].style.display = '';
                } else {
                    userCards[i].style.display = 'none';
                }
            }
        }
    }
</script>
@endsection