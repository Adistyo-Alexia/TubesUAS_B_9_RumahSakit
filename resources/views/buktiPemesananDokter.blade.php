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
            padding: 15px;
            margin-bottom: 20px;
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

        .order-detail .order-price {
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
            background-color: #f0f8ff;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #c0d3f0;
            margin-top: 20px;
        }

        .order-box h5 {
            font-weight: bold;
            color: #003366;
        }

        .order-box p {
            margin: 5px 0;
            font-size: 16px;
            color: #333;
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

        .container {
            max-width: 1200px;
            margin: 40px auto;
        }
    </style>
</head>
<body>
    
    <div class="header">
        <div class="logo"><a href="{{ url('/home') }}" class="logo">Atma Hospital</a></div>
        <div class="layanan">
            <strong>LAYANAN</strong>
        </div>
    </div>

   
    <div class="breadcrumb">
        <p>Beranda > Dokter at Home > Pembayaran > <strong>Detail & Bukti Pemesanan</strong></p>
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
                <h3 class="text-center" style="color: #003366;">Bukti Pemesanan</h3>
                
                <div class="order-box">
                    <h5>Detail Order</h5>
                    <p>Paket Layanan Dokter At Home</p>
                    <p><strong>{{ $doctor['name'] }}</strong><br>{{ $doctor['specialization'] }} - {{ $doctor['specialization_detail'] }}</p>
                    <p class="order-price">IDR 750.000 ({{ $doctor['payment_method'] }})</p>
                    <p>ID Pemesanan : <strong>{{ uniqid() }}</strong></p>
                    <p>Tanggal Pemesanan : <strong>{{ now()->format('d F Y') }}</strong></p>
                    <p>Waktu Konsultasi : <strong>{{ $doctor['appointment_time'] }} WIB</strong></p>
                </div>
                
                <a href="{{url('/home')}}" class="btn-primary">Kembali ke Beranda</a>
                <form action="{{ route('transaksi.storeDokter') }}" method="POST">
                    @csrf
                    <input type="hidden" name="jumlah" value="750000">
                    <input type="hidden" name="metode_pembayaran" value="{{ $doctor['payment_method'] }}">
                    <input type="hidden" name="waktu_konsultasi" value="{{ $doctor['appointment_time'] }}">

                    <button type="submit" class="btn-primary">Simpan Transaksi</button>
                </form>

                
                <div class="text-center">
                    <a href="{{url('/dokter-home')}}">Pesan lagi</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
