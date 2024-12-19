<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
        }
        /* Sidebar Styles */
        .sidebar {
            background-color: #0d47a1;
            color: white;
            min-height: 100vh;
            padding: 20px 15px;
            width: 220px;
            position: fixed;
            top: 0;
            left: 0;
            transition: width 0.3s;
        }
        .sidebar.collapsed {
            width: 80px;
        }
        .doctor-name {
            font-size: 14px; /* Sesuaikan ukuran font sesuai kebutuhan */
        }
        .sidebar.collapsed .logo h2,
        .sidebar.collapsed .logo h5,
        .sidebar.collapsed h4 span {
            display: none; /* Sembunyikan teks saat sidebar collapsed */
        }
        .sidebar .logo {
            display: flex;
            align-items: center;
        }
        .sidebar .logo img {
            width: 40px; /* Placeholder ukuran logo */
            height: 40px;
            margin-right: 10px;
        }
        .sidebar .logo h2 {
            font-size: 18px; /* Sesuaikan ukuran tulisan */
        }
        .sidebar h5 {
            display: flex;
            align-items: center;
        }
        .sidebar h5 img {
            width: 40px;
            height: 40px;
            margin-right: 10px;
            border-radius: 50%;
        }
        .sidebar.collapsed h5 img {
            margin: auto; /* Pusatkan gambar saat sidebar collapsed */
        }
        .sidebar.collapsed h5 span {
            display: none; /* Sembunyikan teks Dr. Laurentius Andre saat sidebar collapsed */
        }
        .sidebar h5 span {
            white-space: nowrap;
        }
        .sidebar h4 {
            display: flex;
            align-items: center;
            margin-top: 30px;
            padding-left: 10px;
        }
        .sidebar h4 i {
            margin-right: 10px;
        }
        .sidebar.collapsed h4 i {
            margin-right: 0; /* Hilangkan margin ikon saat collapsed */
        }
        .sidebar h4 img {
            width: 30px;
            height: 30px;
            margin-right: 10px;
        }
        .sidebar h4 span {
            margin-left: 10px;
        }
        .sidebar h4 {
            white-space: nowrap;
        }
        .sidebar.collapsed h4 {
            justify-content: center;
        }
        /* Header Styles */
        .header {
            background-color: #fff;
            padding: 10px 20px;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            width: calc(100% - 220px); /* Header width reduced by sidebar width */
            left: 220px;
            top: 0;
            z-index: 1000;
            transition: left 0.3s, width 0.3s;
        }
        .header.collapsed {
            width: calc(100% - 80px);
            left: 80px;
        }
        .header .menu-icon {
            font-size: 24px;
            cursor: pointer;
            color: #000;
        }
        .header .actions {
            display: flex;
            align-items: center;
        }
        .header .actions button {
            margin-left: 10px;
        }
        /* Main Content Styles */
        .main-content {
            margin-left: 220px;
            padding: 60px 30px; /* Adjusted for fixed header */
            transition: margin-left 0.3s;
        }
        .main-content.collapsed {
            margin-left: 80px;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <!-- Sidebar di dashboard_konsultasi.blade.php -->
    <div class="sidebar" id="sidebar">
        <div class="logo">
            <img src="{{ asset('image/logo.png') }}" alt="Logo Rumah Sakit" id="hospitalLogo">
            <h2>Atma Hospital</h2>
        </div>
        <hr>
        <h5>
            <img src="{{ asset('image/doctor.png') }}" alt="Foto Dr. Laurentius Andre" id="doctorPhoto">
            <span class="doctor-name">Dr. Laurentius Andre</span>
        </h5>
        <hr>
        <h4>
            <a href="{{ url('/tambah-konsultasi') }}" style="text-decoration: none; color: white;">
                <img src="{{ asset('image/consultation-icon.png') }}" alt="Konsultasi Icon" id="consultationIcon">
                <span>Konsultasi</span>
            </a>
        </h4>
    </div>
    <!-- Header -->
    <div class="header" id="header">
        <div class="menu-icon" id="menuToggle">
            <i class="fas fa-bars"></i>
        </div>
        <div class="actions">
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</button>
            <button class="btn btn-light"><i class="fas fa-expand"></i></button>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        @yield('content')
    </div>

    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin keluar?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="confirmLogout">Logout</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies (Optional if you need JS functionality) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome JS (Optional if you need JS for icons) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script>
    document.getElementById('menuToggle').addEventListener('click', function() {
        var sidebar = document.getElementById('sidebar');
        var mainContent = document.getElementById('mainContent');
        var header = document.getElementById('header');
        sidebar.classList.toggle('collapsed');
        mainContent.classList.toggle('collapsed');
        header.classList.toggle('collapsed');
    });

    // Fungsi untuk toggle fullscreen
    document.querySelector('.btn-light').addEventListener('click', function() {
        const expandBtn = this;
        
        if (!document.fullscreenElement) {
            document.documentElement.requestFullscreen()
                .then(() => {
                    expandBtn.innerHTML = '<i class="fas fa-compress"></i>';
                })
                .catch(err => {
                    console.log(`Error attempting to enable fullscreen: ${err.message}`);
                });
        } else {
            document.exitFullscreen()
                .then(() => {
                    expandBtn.innerHTML = '<i class="fas fa-expand"></i>';
                })
                .catch(err => {
                    console.log(`Error attempting to exit fullscreen: ${err.message}`);
                });
        }
    });

    // Fungsi logout tetap sama
    document.getElementById('confirmLogout').addEventListener('click', function() {
        window.location.href = '/';
    });

    // Tambahkan event listener untuk perubahan fullscreen
    document.addEventListener('fullscreenchange', function() {
        const expandBtn = document.querySelector('.btn-light');
        if (!document.fullscreenElement) {
            expandBtn.innerHTML = '<i class="fas fa-expand"></i>';
        }
    });
</script>
</body>
</html>
