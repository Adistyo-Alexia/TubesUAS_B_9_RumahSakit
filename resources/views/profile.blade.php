<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Atma Hospital</title>
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
        }

        .header .logo {
            font-size: 30px;
            color: white;
            text-decoration: none;
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

        /* Tambahkan gaya untuk tombol kotak */
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
        }

        .content h3 {
            font-size: 24px;
            font-weight: bold;
            color: #003366;
            margin-bottom: 20px;
        }

        .content input, .content textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .content input[disabled], .content textarea[disabled] {
            background-color: #f9f9f9;
            cursor: not-allowed;
        }

        .edit-profile {
            text-align: right;
            margin-top: 20px;
        }

        .edit-profile a {
            text-decoration: none;
            color: #003366;
            font-weight: bold;
        }

        .edit-profile a:hover {
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
        <button class="btn btn-danger float-right" data-toggle="modal" data-target="#logoutModal">Logout</button>
    </div>

    <div class="breadcrumb">
        <p>Beranda > Akun Saya > <strong>Profile</strong></p>
    </div>

    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <h3>Selamat Datang</h3>
            <a href="{{ url('/riwayat-transaksi') }}">Riwayat Aktivitas & Transaksi</a><br><br>
            <a href="{{ url('/profile') }}" class="active">Profile</a>
        </div>

        <!-- Content -->
        <div class="content">
            <h3>Profile</h3>

            <!-- Form Data Profile -->
            <form>
                <div class="row">
                    <div class="col-md-6">
                        <label for="name">Nama</label>
                        <input type="text" id="name" value="{{ $user->nama }}" disabled>

                        <label for="phone">Nomor Telepon</label>
                        <input type="text" id="phone" value="{{ $user->no_telepon }}" disabled>

                        <label for="email">Email</label>
                        <input type="email" id="email" value="{{ $user->email }}" disabled>

                        <label for="username">Username</label>
                        <input type="text" id="username" value="{{ $user->nama_pengguna }}" disabled>
                    </div>

                    <div class="col-md-6">
                        <label for="gender">Jenis Kelamin</label>
                        <input type="text" id="gender" value="{{ $user->jenis_kelamin }}" disabled>

                        <label for="address">Alamat Lengkap</label>
                        <textarea id="address" rows="4" disabled>{{ $user->alamat }}</textarea>

                        <label for="birthdate">Tanggal Lahir (dd-mm-yyyy)</label>
                        <input type="text" id="birthdate" value="{{ $user->tanggal_lahir }}" disabled>
                    </div>
                </div>
                <!-- Edit Profile Button -->
                <div class="edit-profile">
                    <a href="{{ route('profile.edit') }}">Edit Profile</a>
                </div>
            </form>
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body> 
</html>