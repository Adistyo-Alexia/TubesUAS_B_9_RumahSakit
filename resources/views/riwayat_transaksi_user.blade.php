<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile / Riwayat Aktivitas & Transaksi</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .header {
            background-color: #003366;
            color: white;
            padding: 20px;
            text-align: left;
            font-size: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header .logo {
            font-size: 30px;
            color: white;
            text-decoration: none;
        }

        .header .logout-btn {
            background-color: #f8f9fa;
            color: #003366;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .header .logout-btn:hover {
            background-color: #ddd;
        }

        .breadcrumb {
            margin: 20px;
            color: #666;
        }

        .sidebar {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            margin-right: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .sidebar h3 {
            font-size: 24px;
            font-weight: bold;
            color: #003366;
        }

        .sidebar a {
            display: block;
            text-decoration: none;
            color: #003366;
            font-size: 18px;
            background-color: #f4f4f4;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: all 0.3s ease;
        }

        .sidebar a:hover {
            background-color: #d9e4f2;
            text-decoration: none;
        }

        .sidebar a.active {
            background-color: #003366;
            color: white;
        }

        .content {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
        }

        .content h3 {
            font-size: 24px;
            font-weight: bold;
            color: #003366;
            margin-bottom: 20px;
        }

        .transaction-card {
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .transaction-card p {
            margin: 0;
        }

        .transaction-card .service {
            color: #003366;
            font-weight: bold;
            text-decoration: none;
        }

        .transaction-card .price {
            color: #003366;
            font-size: 18px;
            font-weight: bold;
        }

        .transaction-card .order-id {
            font-size: 12px;
            color: #999;
        }

        .transaction-card .action {
            text-align: right;
        }

        .transaction-card .action a {
            color: #003366;
            text-decoration: none;
            font-weight: bold;
        }

        .transaction-card .action a:hover {
            text-decoration: underline;
        }

        /* Responsive */
        @media (min-width: 768px) {
            .container {
                display: flex;
                justify-content: flex-start;
            }
        }
    </style>
</head>
<body>

    <div class="header">
        <a href="{{ url('/home') }}" class="logo">Atma Hospital</a>
        <button class="logout-btn" data-toggle="modal" data-target="#logoutModal">Logout</button>
    </div>

    <div class="breadcrumb">
        <p>Beranda > Akun Saya > <strong>Riwayat Aktivitas & Transaksi</strong></p>
    </div>

    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <h3>Selamat Datang</h3>
            <a href="{{ url('/riwayat-transaksi') }}" class="active">Riwayat Aktivitas & Transaksi</a>
            <a href="{{ url('/profile') }}">Profile</a>
        </div>

        <!-- Content -->
        <div class="content">
            <h3>Riwayat Aktivitas & Transaksi</h3>

            <!-- Transaction List -->
            <div class="transaction-card">
                <p><strong>Tanggal Pemesanan :</strong> 21 Oktober 2024</p>
                <p><strong>Waktu Konsultasi :</strong> 14.00 WIB - Selesai</p>
                <p><a href="#" class="service">Layanan</a> Paket Layanan Dokter At Home</p>
                <p>dr. Coky Putra<br>Kedokteran Umum - Dokter Umum</p>
                <p class="price">IDR 750.000 (BRI)</p>
                <p class="order-id">ID Pemesanan : 1001712</p>
                <div class="action">
                    <a href="#">Pesan lagi</a>
                </div>
            </div>

            <div class="transaction-card">
                <p><strong>Tanggal Pemesanan :</strong> 22 Oktober 2024</p>
                <p><strong>Status :</strong> Sedang Disiapkan</p>
                <p><a href="#" class="service">Layanan</a> Paket Layanan Silver Catering Package</p>
                <p class="price">IDR 1.000.000 (BRI)</p>
                <p class="order-id">ID Pemesanan : 1001713</p>
                <div class="action">
                    <a href="#">Pesan lagi</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Logout</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin keluar?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <a href="{{ url('/logout') }}" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
