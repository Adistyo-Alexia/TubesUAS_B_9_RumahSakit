<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dokter at Home - Atma Hospital</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }

        .breadcrumb {
            background-color: #f8f9fa;
            padding: 15px;
            margin-bottom: 20px;
        }

        .breadcrumb p {
            margin: 0;
            font-size: 14px;
        }

        .breadcrumb p strong {
            color: #003366;
        }

        .search-bar {
            margin: 20px 0;
        }

        .search-bar label {
            font-size: 28px;
            color: #003366;
            display: block;
            margin-bottom: 10px;
        }

        .search-bar input {
            width: 100%;
            max-width: 700px;
            padding: 12px;
            font-size: 16px;
            border: 2px solid #1a73e8;
            border-radius: 8px;
            color: #333;
            outline: none;
            box-shadow: none;
        }

        .search-bar input::placeholder {
            color: #aaa;
        }

        .search-bar input:focus {
            border-color: #003366;
            box-shadow: 0 0 5px rgba(0, 51, 102, 0.5);
        }

        .doctor-container {
            display: flex;
            flex-wrap: wrap;
            gap: 40px; 
            justify-content: flex-start;
        }

        .doctor-card {
            background-color: white;
            border: 1px solid #1a73e8;
            border-radius: 8px;
            padding: 20px;
            width: 320px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            text-align: left;
            margin-bottom: 30px; 
        }

        .doctor-card:hover {
            transform: scale(1.05);
        }

        .doctor-card img {
            border-radius: 50%;
            width: 80px;
            height: 80px;
            margin-right: 10px;
            border: 2px solid #1a73e8;
        }

        .doctor-card h5 {
            font-size: 18px;
            margin-bottom: 5px;
            color: #003366;
        }

        .doctor-card p {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }

        .doctor-card .status {
            font-size: 14px;
            margin-bottom: 10px;
        }

        .doctor-card .status span {
            color: #003366;
            font-weight: bold;
        }

        .doctor-card button {
            background-color: #003366;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            width: 100%;
        }

        .doctor-card button:disabled {
            background-color: #ddd;
            cursor: not-allowed;
        }

        .doctor-card button:hover:not(:disabled) {
            background-color: #002244;
        }

        .doctor-info {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
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
        <p>Beranda > <strong> Dokter at Home</strong></p>
    </div>

    <div class="container">
        <div class="search-bar">
            <label for="search">Cari Dokter</label>
            <input type="text" id="search" placeholder="Ketik nama dokter" onkeyup="filterDoctors()">
        </div>

        <h3>Semua Dokter</h3>

        <div class="doctor-container">
            @foreach($doctors as $doctor)
                <div class="doctor-card" data-doctor-id="{{ $doctor['id'] }}">
                    <div class="doctor-info">
                        <img src="{{ asset($doctor['photo']) }}" alt="{{ $doctor['name'] }}">
                        <div>
                            <h5>{{ $doctor['name'] }}</h5>
                            <p>{{ $doctor['specialization'] }} - {{ $doctor['specialization_detail'] }}</p>
                        </div>
                    </div>
                    <div class="status">
                        Tersedia: <span>{{ $doctor['available_today'] ? 'Tersedia hari ini' : 'Tidak tersedia hari ini' }}</span>
                    </div>
                    <a href="{{ route('dokter.detail', ['id' => $doctor['id']]) }}">
                        <button>Lihat Detail & Pesan</button>
                    </a>                
                </div>
            @endforeach
        </div>

    </div>

    <script>
        function filterDoctors() {
            const searchValue = document.getElementById('search').value.toLowerCase();
            const doctorCards = document.querySelectorAll('.doctor-card');
            
            doctorCards.forEach(card => {
                const name = card.querySelector('h5').textContent.toLowerCase();
                const specialization = card.querySelector('p').textContent.toLowerCase();
                
                if (name.includes(searchValue) || specialization.includes(searchValue)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    </script>
</body>
</html>
