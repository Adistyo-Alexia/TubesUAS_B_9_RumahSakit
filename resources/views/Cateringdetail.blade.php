<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Catering - {{ $catering->nama }}</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f4;
        }
        .header {
            background-color: #003366;
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header .logo a {
            font-size: 30px;
            color: white;
            text-decoration: none;
        }
        .header .layanan {
            font-size: 24px;
            font-weight: bold;
        }
        .breadcrumb {
            background-color: #f8f9fa;
            padding: 15px;
            margin-bottom: 20px;
        }
        .catering-detail {
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        .catering-image {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .catering-info h2 {
            color: #003366;
            margin-bottom: 20px;
        }
        .catering-info p {
            color: #666;
            margin-bottom: 10px;
        }
        .catering-price {
            font-size: 1.8em;
            color: #28a745;
            font-weight: bold;
            margin-top: 20px;
        }
        .btn-custom {
            background-color: #0056b3;
            color: white;
            font-size: 1.2em;
            padding: 12px 30px;
            border-radius: 5px;
            border: none;
            transition: background-color 0.3s;
            width: 100%;
            max-width: 300px;
            margin: 20px auto;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="logo">
            <a href="{{url('/home')}}"><strong>Atma Hospital</strong></a>
        </div>
        <div class="layanan">LAYANAN</div>
    </div> 

    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <p>Beranda > Catering Package > <strong>Detail Catering</strong></p>
    </div>

    <div class="container">
        <div class="catering-detail">
            <div class="catering-info">
                <h2>{{ $catering->nama }}</h2>
                <p><strong>Deskripsi:</strong><br>{{ $catering->deskripsi }}</p>
                <p><strong>Detail Menu:</strong><br>{{ $catering->detail_menu }}</p>
                <p><strong>Durasi:</strong> {{ $catering->durasi }} hari</p>
                <p class="catering-price">Harga: Rp. {{ number_format($catering->harga, 0, ',', '.') }}</p>
            </div>
            <div class="text-center">
                    <a href="{{ route('pembayaran.show', ['id' => $catering->id]) }}">
                    <button class="btn-custom">Lanjut Pembayaran</button>
                </a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
