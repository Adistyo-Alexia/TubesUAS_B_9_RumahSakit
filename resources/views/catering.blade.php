<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atma Hospital Catering Package</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
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
            font-size: 26px;
            color: white;
            text-decoration: none;
        }
        .breadcrumb {
            margin: 20px;
            color: #666;
            text-align: left;
        }
        .search-bar {
            margin: 20px;
            text-align: left;
            color: blue;
            font-size: 32px;
        }
        .search-bar input {
            width: 50%; 
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            max-width: 500px; 
        }
        .package-container {
            display: flex;
            justify-content: space-between;
            margin: 20px;
        }
        .package {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            width: 30%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s;
        }
        .package:hover {
            transform: scale(1.05);
        }
        .package h3 {
            font-size: 28px; 
            margin-bottom: 10px;
            color: #333;
            border-bottom: 2px solid #ddd; 
            padding-bottom: 10px;
            width: 55%; 
            margin-left: auto;
            margin-right: auto;
        }
        .package p {
            font-size: 24px;
            margin-bottom: 20px;
            color: #003366;
        }
        .package button {
            background-color: #003366;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        .package button:hover {
            background-color: #002244;
        }

    </style>
</head>
<body>

    <div class="header">
        <div class="logo"><a href="{{url('/home')}}"><strong>Atma Hospital</strong></a></div>
        <div class="layanan">
            <strong>LAYANAN</strong>
        </div>
    </div>

    <div class="breadcrumb">
        <p>Beranda > <strong> Catering Package</strong></p>
    </div>


    <div class="container">
    <div class="search-bar">
        <label for="search">Cari Package</label><br>
        <input type="text" id="search" placeholder="Ketik nama Package" onkeyup="filterPackages()">
    </div>

    <h3 style="margin-left: 20px;">Semua Package</h3>

    <div class="package-container">
    @if ($catering->isEmpty())
        <p>Tidak ada data catering tersedia.</p>
    @else
        @foreach ($catering as $item)
            <div class="package">
                <h3>{{ $item->nama }}</h3>
                <p>{{ $item->deskripsi }}</p>
                
                <p class="detail-menu" style="font-size: 14px; color: #555;">
                    <strong>Detail Menu:</strong> {{ $item->detail_menu }}
                </p>
                <p class="durasi" style="font-size: 16px; color: #003366;">
                    Lama catering: <strong>{{ $item->durasi }} hari</strong>
                </p>
                <p class="harga" style="font-size: 24px; color: #003366;">
                    <strong>Harga: Rp. 500.000</strong>
                </p>

                <a href="{{ url('/catering-detail/'.$item->id) }}">
                    <button>Beli Package</button>
                </a>
                
            </div>
        @endforeach
    @endif
    </div>
    </div>

    <script>
        function filterPackages() {
            const searchValue = document.getElementById('search').value.toLowerCase();
            const packages = document.querySelectorAll('.package');
            
            packages.forEach(packageCard => {
                const packageName = packageCard.querySelector('h3').textContent.toLowerCase();
                
                if (packageName.includes(searchValue)) {
                    packageCard.style.display = '';
                } else {
                    packageCard.style.display = 'none';
                }
            });
        }
    </script>

</body>
</html>