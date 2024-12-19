<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hubungi Kami - Atma Hospital</title>
    <style>
        body {
            margin: 0;
            font-family: sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        .header {
            background-color: #003366;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 36px;
        }

        .nav {
            background-color: #003366;
            padding: 10px;
            display: flex;
            justify-content: space-around;
        }

        .nav a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            position: relative;
        }

        .nav a:hover {
            text-decoration: underline;
        }

        /* Dropdown CSS */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
            border-radius: 5px;
        }

        .dropdown-content a {
            color: #003366;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            font-size: 16px;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .contact-section {
            text-align: center;
            padding: 50px 20px;
        }

        .contact-section h2 {
            font-size: 32px;
            font-weight: bold;
            color: #003366;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 10px;
        }

        .contact-section hr {
            width: 100px;
            border: 1px solid #003366;
            margin: 20px auto;
        }

        .contact-details {
            max-width: 900px;
            margin: 0 auto;
            text-align: left;
            line-height: 1.8;
            color: #666;
            padding: 0 20px;
        }

        .contact-details h3 {
            font-size: 20px;
            color: #003366;
            margin-bottom: 10px;
        }

        .contact-details p {
            margin: 5px 0;
            color: #333;
        }

        .contact-details ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .contact-details ul li {
            margin-bottom: 10px;
            color: #333;
        }

        .contact-details ul li:before {
            content: '•';
            color: #003366;
            font-weight: bold;
            display: inline-block;
            width: 15px;
            margin-left: -15px;
        }

        .partner-section {
            padding: 50px;
            text-align: center;
            background-color: #f4f4f4;
            margin-top: 50px;
        }

        .partner-section h3 {
            font-size: 24px;
            font-weight: bold;
            color: #003366;
            margin-bottom: 20px;
        }

        .partner-section img {
            max-width: 150px;
            margin-top: 30px;
        }

        footer {
            background-color: #003366;
            padding: 20px;
            text-align: center;
            color: white;
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
        <a href="#">Cari Resep</a>
        <a href="{{ route('pusatInformasi') }}">Pusat Informasi</a>
        <a href="{{ url('/profile') }}">Profile</a>
    </div>

    <div class="contact-section">
        <h2>Hubungi Kami</h2>
        <hr>
        <div class="contact-details">
            <h3>CONTACT CENTER</h3>
            <p>Telepon: 1-654-203</p>
            <p>WhatsApp: +62-921-8231-131</p>
            <p>Untuk pertanyaan dan pelayanan terkait:</p>
            <ul>
                <li>Pelayanan yang disediakan</li>
                <li>Konfirmasi jadwal dokter</li>
                <li>Pembelian obat</li>
            </ul>
            <p><strong>Waktu Pelayanan:</strong> Senin-Minggu, pukul 06.00-21.00</p>
            <h3>KARIR</h3>
            <p>Untuk pertanyaan terkait karir, silakan kontak instagram @atmaHospitals</p>
            <h3>PARTNERSHIP</h3>
            <p>Untuk kerjasama, silahkan hubungi email di bawah ini:</p>
            <p>partnership.atma@atmahospitals.com</p>
        </div>
    </div>

    <div class="partner-section">
        <h3>Mitra Kami</h3>
        <img src="{{ asset('image/UAJY.jpg') }}" alt="Universitas Atma Jaya">
    </div>
</body>
</html>
