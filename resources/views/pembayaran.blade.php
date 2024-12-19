<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $paketKatering->nama }} - Pembayaran</title>
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
        .order-section {
            display: flex;
            justify-content: space-between;
            margin-top: 50px;
        }
        .order-info, .payment-method {
            width: 48%;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
        }
        .order-info h4, .payment-method h4 {
            color: #003366;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .payment-button {
            text-align: center;
            margin-top: 30px;
        }
        .payment-button button {
            background-color: #003366;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 18px;
            border-radius: 8px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="logo"><a href="{{ url('/') }}"><strong>Atma Hospital</strong></a></div>
        <div class="layanan"><strong>LAYANAN</strong></div>
    </div>

    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <p>Beranda > Catering Package > Detail > <strong>Pembayaran</strong></p>
    </div>

    <!-- Order Section -->
    <div class="container">
        <div class="order-section">
            <!-- Order Information -->
            <div class="order-info">
                <h4>Informasi Pemesanan</h4>
                <p><strong>Paket:</strong> {{ $paketKatering->nama }}</p>
                <p><strong>Deskripsi:</strong> {{ $paketKatering->deskripsi }}</p>
                <p><strong>Durasi:</strong> {{ $paketKatering->durasi }} Hari</p>
                <p><strong>Harga:</strong> Rp. {{ number_format($paketKatering->harga, 0, ',', '.') }}</p>

            </div>

            <!-- Payment Methods -->
            <form action="{{ route('bukti.pembayaran') }}" method="POST">
                @csrf 
                <!-- Hidden Inputs untuk Data Paket -->
                <input type="hidden" name="nama" value="{{ $paketKatering->nama }}">
                <input type="hidden" name="harga" value="{{ $paketKatering->harga }}">
                
                <!-- Pilih Metode Pembayaran -->
                <div class="payment-options">
                    <h5>Transfer Bank</h5>
                    <label><input type="radio" name="payment-method" value="BRI" required> BRI</label>
                    <label><input type="radio" name="payment-method" value="BNI"> BNI</label>
                    <label><input type="radio" name="payment-method" value="BCA"> BCA</label>
                    <label><input type="radio" name="payment-method" value="Mandiri"> Mandiri</label>

                    <h5 class="mt-4">E-Wallet</h5>
                    <label><input type="radio" name="payment-method" value="DANA"> DANA</label>
                    <label><input type="radio" name="payment-method" value="OVO"> OVO</label>
                    <label><input type="radio" name="payment-method" value="GoPay"> GoPay</label>
                </div>
                <div class="payment-button">
                    <button type="submit">Lanjutkan Pembayaran</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
