<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atma Hospital</title>
    <style>
        body {
            margin: 0;
            font-family: sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Min-height agar body selalu setinggi viewport */
        }

        .header {
            background-color: #003366;
            color: white;
            padding: 20px;
            text-align: center;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header h1 {
            margin: 0;
        }

        .nav {
            display: flex;
            justify-content: center;
            background-color: #003366;
            padding: 15px 0;
            font-size: 16px;
        }

        .nav a {
            color: white;
            text-decoration: none;
            margin: 0 20px;
            padding: 5px 10px;
            position: relative;
            transition: all 0.3s ease;
        }

        .nav a::after {
            content: '';
            display: block;
            width: 0;
            height: 2px;
            background-color: white;
            transition: width 0.3s ease;
            position: absolute;
            bottom: 0;
            left: 0;
        }

        .nav a:hover::after {
            width: 100%; /* Garis bawah saat hover */
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            border-radius: 5px;
        }

        .dropdown-content a {
            color: #003366;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .container {
            padding: 100px 20px;
            background-image: url('{{ asset('image/rumah-sakit2.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            flex-grow: 1; /* Membuat container tumbuh untuk memenuhi ruang yang tersedia */
            color: white;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .container h2 {
            font-size: 36px;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
            margin-bottom: 20px;
        }

        .container p {
            font-size: 18px;
            font-weight: 300;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.6);
        }

        .footer {
            background-color: #003366;
            color: white;
            padding: 20px;
            text-align: center;
            margin-top: auto; /* Membuat footer selalu berada di bawah */
        }

        .footer p {
            margin: 0;
            font-size: 14px;
        }

    </style>
</head>
<body>
    <div class="header">
        <h1>Atma Hospital</h1>
    </div>

    <div class="nav">
        <a href="{{url('/home')}}">Beranda</a>       
        <div class="dropdown">
            <a href="javascript:void(0)">Cari Layanan</a>
            <div class="dropdown-content">
                <a href="{{url('/dokter-home')}}">Dokter At Home</a>
                <a href="{{url('/catering')}}">Catering Package</a>
            </div>
        </div>
        <a href="{{ url('/cari-resep') }}">Cari Resep</a>
        <a href="{{ route('pusatInformasi') }}">Pusat Informasi</a>
        <a href="{{ url('/profile') }}">Profile</a>
    </div>
    
    <div class="container">
        <h2>Selamat datang di Atma Hospital!</h2>
        <p>Pelayanan terbaik untuk kesehatan Anda</p>
    </div>

    <div class="footer">
        <p>&copy; 2024 Atma Hospital. All Rights Reserved.</p>
    </div>
</body>
</html>
