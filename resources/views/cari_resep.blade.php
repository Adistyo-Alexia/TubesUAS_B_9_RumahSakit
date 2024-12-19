<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Resep - Atma Hospital</title>
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

        .search-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px;
        }

        .search-container h3 {
            font-size: 24px;
            color: #003366;
        }

        .search-container input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 10px;
        }

        .search-container button {
            margin-top: 10px;
            padding: 10px;
            background-color: #003366;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .search-container button:hover {
            background-color: #002244;
        }

        .recipe-container {
            display: none; /* Sembunyikan container resep sampai data tersedia */
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px;
        }

        .recipe-container h3 {
            font-size: 24px;
            color: #003366;
        }

        .recipe-container p {
            margin: 5px 0;
            color: #333;
        }
    </style>
</head>
<body>

    <div class="header">
        <a href="{{ url('/home') }}" class="logo">Atma Hospital</a>
    </div>

    <div class="breadcrumb">
        <p>Beranda > <strong>Cari Resep</strong></p>
    </div>

    <div class="search-container">
        <h3>Cari Resep</h3>
        <input type="text" id="search" placeholder="Masukkan ID Resep">
        <button onclick="searchRecipe()">Cari Resep</button>
    </div>

    <div class="recipe-container" id="recipeContainer">
        <h3>Tampil Resep</h3>
        <p><strong>Tanggal:</strong> <span id="tanggal"></span></p>
        <p><strong>Jumlah Obat:</strong> <span id="jumlah_obat"></span></p>
        <p><strong>Daftar Obat:</strong></p>
        <ul id="daftar_obat"></ul>
        <p><strong>Catatan:</strong> <span id="catatan"></span></p>
    </div>

    <script>
            function searchRecipe() {
                const recipeId = document.getElementById('search').value;

                if (recipeId) {
                    fetch("{{ route('resep.cari') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({ id_resep: recipeId })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            document.getElementById('tanggal').innerText = data.data.tanggal;
                            document.getElementById('jumlah_obat').innerText = data.data.jumlah_obat;
                            document.getElementById('daftar_obat').innerHTML = data.data.daftar_obat
                                .map(obat => `<li>${obat}</li>`).join('');
                            document.getElementById('catatan').innerText = data.data.catatan;

                            document.getElementById('recipeContainer').style.display = 'block';
                        } else {
                            alert(data.message);
                            document.getElementById('recipeContainer').style.display = 'none';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan, coba lagi.');
                    });
                } else {
                    alert("Silakan masukkan ID resep.");
                    document.getElementById('recipeContainer').style.display = 'none';
                }
            }
        </script>


</body>
</html>
