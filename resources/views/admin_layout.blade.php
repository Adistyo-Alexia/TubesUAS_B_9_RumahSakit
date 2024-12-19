<!-- resources/views/admin_layout.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Efek hover pada tombol di sidebar */
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            position: relative;
            transition: color 0.3s ease;
        }

        /* Efek hover: garis horizontal di bawah teks */
        .sidebar a::after {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            height: 2px;
            background-color: white;
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        /* Ketika hover, garis horizontal muncul */
        .sidebar a:hover::after {
            transform: scaleX(1);
        }

        /* Ketika hover, teks tetap putih */
        .sidebar a:hover {
            color: white;
        }

        /* Efek hover saat sidebar collapsed */
        .sidebar.collapsed a:hover::after {
            transform: scaleX(1);
        }

        /* Sidebar Styles lainnya */
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
        }
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
            white-space: nowrap;
            overflow: hidden;
        }
        .sidebar.collapsed {
            width: 80px;
        }
        .sidebar .logo {
            display: flex;
            align-items: center;
        }
        .sidebar .logo img {
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }
        .sidebar .logo h2 {
            font-size: 18px;
        }
        .sidebar h5 {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .sidebar h5 img {
            width: 40px;
            height: 40px;
            margin-right: 10px;
            border-radius: 50%;
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
        .sidebar.collapsed h4 span,
        .sidebar.collapsed h5 span,
        .sidebar.collapsed .logo h2 {
            display: none;
        }
        .sidebar.collapsed h4 {
            justify-content: center;
        }
        .sidebar.collapsed h5 img {
            margin: auto;
        }
        .header {
            background-color: #fff;
            padding: 10px 20px;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            width: calc(100% - 220px);
            left: 220px;
            top: 0;
            z-index: 1000;
            transition: left 0.3s, width 0.3s;
        }
        .header.collapsed {
            width: calc(100% - 80px);
            left: 80px;
        }
        .main-content {
            margin-left: 220px;
            padding: 60px 30px;
            transition: margin-left 0.3s;
        }
        .main-content.collapsed {
            margin-left: 80px;
        }
        .main-content .container {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="logo">
            <img src="{{ asset('image/logo.png') }}" alt="Logo Rumah Sakit">
            <h2>Atma Hospital</h2>
        </div>
        <hr>
        <h5>
            <a href="{{ url('/profile-admin') }}" style="color: white; text-decoration: none;">
                <img src="{{ asset('image/doctor.png') }}" alt="Foto Admin" class="rounded-circle" style="width: 40px;">
                <span class="doctor-name">Admin Atma</span>
            </a>
        </h5>
        <hr>
        <!-- Menu Users -->
        <h4>
            <a href="{{ url('/admin-dashboard') }}" style="color: white; text-decoration: none;">
                <i class="fas fa-users"></i>
                <span>Users</span>
            </a>
        </h4>
        <!-- Menu Doctors -->
        <h4>
            <a href="{{ url('/doctors-admin') }}" style="color: white; text-decoration: none;">
                <i class="fas fa-user-md"></i>
                <span>Doctors</span>
            </a>
        </h4>
        <!-- Menu Services -->
        <h4>
            <a href="{{ url('/layanan-admin') }}" style="color: white; text-decoration: none;">
                <i class="fas fa-cogs"></i>
                <span>Services</span>
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
            <button class="btn btn-light" id="expandBtn"><i class="fas fa-expand"></i></button>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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

        document.addEventListener('DOMContentLoaded', function() {
            const expandButton = document.querySelector('.btn-light');
            
            expandButton.addEventListener('click', function() {
                if (!document.fullscreenElement) {
                    if (document.documentElement.requestFullscreen) {
                        document.documentElement.requestFullscreen();
                    } else if (document.documentElement.webkitRequestFullscreen) {
                        document.documentElement.webkitRequestFullscreen();
                    } else if (document.documentElement.msRequestFullscreen) {
                        document.documentElement.msRequestFullscreen();
                    }
                    
                    expandButton.innerHTML = '<i class="fas fa-compress"></i>';
                } else {
                    if (document.exitFullscreen) {
                        document.exitFullscreen();
                    } else if (document.webkitExitFullscreen) {
                        document.webkitExitFullscreen();
                    } else if (document.msExitFullscreen) {
                        document.msExitFullscreen();
                    }
                    
                    expandButton.innerHTML = '<i class="fas fa-expand"></i>';
                }
            });
        });

        document.getElementById('confirmLogout').addEventListener('click', function() {
            window.location.href = '/';
        });
    </script>
    @stack('scripts')
</body>
</html>