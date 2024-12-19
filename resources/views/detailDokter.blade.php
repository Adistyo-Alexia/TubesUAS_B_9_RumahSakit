<!-- resources/views/detailDokter.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Dokter - {{ $doctor['name'] }}</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
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
        }

        .header .logo a {
            color: white;
            text-decoration: none;
        }

        .header .layanan {
            font-size: 24px;
            color: white;
            text-decoration: none;
        }

        .breadcrumb {
            background-color: #f8f9fa;
            padding: 15px;
            margin-bottom: 20px;
        }

        .doctor-profile {
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }

        .doctor-image {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
        }

        .doctor-info h2 {
            color: #003366;
            margin-bottom: 20px;
        }

        .doctor-info p {
            color: #666;
            margin-bottom: 10px;
        }

        .doctor-info .specialty {
            color: #003366;
            font-weight: bold;
            font-size: 1.2em;
            margin-bottom: 15px;
        }

        .status-badge {
            display: inline-block;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.9em;
            margin-bottom: 20px;
        }

        .status-available {
            background-color: #e1f7e1;
            color: #28a745;
        }

        .status-unavailable {
            background-color: #ffe1e1;
            color: #dc3545;
        }

        .appointment-form {
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        .appointment-form h3 {
            color: #003366;
            margin-bottom: 20px;
        }

        .form-group label {
            color: #003366;
            font-weight: 500;
        }

        .btn-primary {
            background-color: #003366;
            border: none;
            padding: 10px 30px;
            font-size: 1.1em;
        }

        .btn-primary:hover {
            background-color: #002244;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">
            <a href="{{url('/home')}}"><strong>Atma Hospital</strong></a>
        </div>
        <div class="layanan">
            <strong>LAYANAN</strong>
        </div>
    </div>

    <div class="breadcrumb">
        <p>Beranda > Dokter at Home > <strong>Detail Dokter</strong></p>
    </div>

    <div class="container">
        <div class="row">
            <!-- Profil Dokter -->
            <div class="col-md-6">
                <div class="doctor-profile">
                    <div class="text-center">
                        <img src="{{ asset($doctor['photo']) }}" alt="{{ $doctor['name'] }}" class="doctor-image">
                    </div>
                    <div class="doctor-info">
                        <h2>{{ $doctor['name'] }}</h2>
                        <div class="specialty">{{ $doctor['specialization'] }}</div>
                        <div class="{{ $doctor['available_today'] ? 'status-badge status-available' : 'status-badge status-unavailable' }}">
                            {{ $doctor['available_today'] ? 'Tersedia hari ini' : 'Tidak tersedia hari ini' }}
                        </div>
                        <p><strong>Spesialisasi:</strong><br>{{ $doctor['specialization_detail'] }}</p>
                        <hr>
                        <h4>Biaya Konsultasi</h4>
                        <p class="h3 text-primary">Rp. 750.000</p>
                    </div>
                </div>
            </div>

            <!-- Form Pemesanan -->
            <div class="col-md-6">
                <div class="appointment-form">
                    <h3>Buat Janji Temu</h3>
                    <form action="{{ route('pesanan.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="doctor_id" value="{{ $doctor['id'] }}">
                        <input type="hidden" name="service_price" value="750000">
                        
                        <div class="form-group">
                            <label>Tanggal Konsultasi</label>
                            <input type="date" class="form-control" name="appointment_date" required>
                        </div>

                        <div class="form-group">
                            <label>Waktu Konsultasi</label>
                            <select class="form-control" name="appointment_time" required>
                                <option value="">Pilih Waktu</option>
                                <option value="09:00">09:00</option>
                                <option value="10:00">10:00</option>
                                <option value="11:00">11:00</option>
                                <option value="13:00">13:00</option>
                                <option value="14:00">14:00</option>
                                <option value="15:00">15:00</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Keluhan/Catatan</label>
                            <textarea class="form-control" name="notes"></textarea>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Lanjut ke Pembayaran</button>
                        </div>
                    </form>                
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>