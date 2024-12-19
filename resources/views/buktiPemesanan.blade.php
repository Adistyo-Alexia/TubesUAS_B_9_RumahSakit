<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bukti Pemesanan - Atma Hospital</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f4;
        }

        .breadcrumb {
            background-color: #f8f9fa;
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
        }

        .header .layanan {
            font-size: 24px;
            color: white;
            text-decoration: none;
        }

        .content-section {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }

        .order-detail {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 45%;
        }

        .order-detail h5 {
            font-weight: bold;
            margin-bottom: 10px;
            color: #003366;
        }

        .order-detail p {
            margin: 5px 0;
        }

        .order-detail .price {
            color: #003366;
            font-weight: bold;
            font-size: 24px;
        }

        .thank-you-section {
            text-align: center;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            width: 50%;
        }

        .thank-you-section img {
            max-width: 100%;
            border-radius: 8px;
        }

        .thank-you-section h2 {
            font-size: 36px;
            font-weight: bold;
            color: #003366;
            margin-top: 20px;
        }

        .thank-you-section p {
            font-size: 18px;
            color: #666666;
        }

        .thank-you-section p.quote {
            font-style: italic;
        }

        .order-box {
            background-color: #e1ecf7;
            padding: 20px;
            margin-top: 20px;
            border-radius: 8px;
            border: 1px solid #c0d3f0;
        }

        .order-box h5 {
            font-weight: bold;
            color: #003366;
        }

        .order-box .order-price {
            font-size: 24px;
            font-weight: bold;
            color: #003366;
        }

        .btn-primary {
            background-color: #003366;
            border-color: #003366;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 16px;
            margin-top: 20px;
            display: block;
            text-align: center;
        }

        .btn-primary:hover {
            background-color: #002244;
        }

        .text-center a {
            font-size: 18px;
            color: #003366;
            margin-top: 20px;
            display: inline-block;
        }

        .text-center a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
   
    <div class="header">
        <div class="logo"><a href="{{url('/')}}"><strong>Atma Hospital</strong></a></div>
        <div class="layanan">
            <strong>LAYANAN</strong>
        </div>
    </div>

    
    <div class="breadcrumb">
        <p>Beranda > Catering Package > Silver Package > Pembayaran > <strong>Detail & Bukti Pemesanan</strong></p>
    </div>

    
    <div class="container">
        <div class="content-section">
            
            <div class="thank-you-section">
                <img src="https://media.istockphoto.com/id/1178536779/id/foto/dokter-dan-staf-keperawatan-dengan-tangan-di-dada.jpg?s=612x612&w=is&k=20&c=o2rjtFIEB0GJL04AqKumHGjPqO5uWr5V1bJiiN0_sEk=" alt="Terima Kasih Atma Hospital">
                <p class="quote">Kami berkomitmen untuk terus memberikan perawatan terbaik dan mendampingi Anda dalam setiap langkah menuju kesehatan dengan sepenuh hati</p>
                <h2>Terima Kasih</h2>
                <p>telah mempercayakan pelayanan kesehatan Anda di Atma Hospital</p>
            </div>

            
            <div class="order-detail">
                <h5>Bukti Pemesanan</h5>
                <div class="order-box">
                    <p><strong>Detail Order</strong></p>
                    <p>Paket Layanan: {{ $paketKatering['nama'] }}</p>
                    <p class="order-price">IDR {{ number_format($paketKatering['harga'], 0, ',', '.') }} ({{ $paketKatering['metode_pembayaran'] }})</p>
                    <p>ID Pemesanan: <strong>{{ $paketKatering['id_pemesanan'] }}</strong></p>
                    <p>Tanggal Pemesanan: <strong>{{ $paketKatering['tanggal_pemesanan'] }}</strong></p>
                </div>
                <a href="{{url('/home')}}" class="btn-primary">Kembali ke Beranda</a>
                <div class="text-center">
                    <a href="{{url('/catering')}}">Pesan lagi</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
