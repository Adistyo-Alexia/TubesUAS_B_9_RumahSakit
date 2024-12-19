<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #FFFFFF;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .container-fluid {
            padding: 0;
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        /* Header */
        .header {
            background-color: #0d47a1;
            color: white;
            height: 80px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: 900; /* Lebih tebal dari "bold" */
        }
        .header h1 {
            font-size: 32px;
            margin: 0;
        }
        /* Main Content */
        .content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        /* Gambar di sebelah kiri */
        .content .image-section {
            flex: 0.60; /* Ukuran gambar 60% */
            background-image: url("{{ asset('image/hospital-background.jpg') }}");
            background-size: cover;
            background-position: center;
            height: 100vh; /* Pastikan gambar memenuhi seluruh tinggi viewport */
            width: 100%; /* Pastikan gambar memenuhi seluruh lebar yang diizinkan */
        }

        /* Form di sebelah kanan */
        .content .form-section {
            flex: 0.40; /* Lebar form diubah menjadi 40% dari total halaman */
            background-color: white;
            padding: 40px;
            margin-right: 100px; /* Margin diatur agar tidak terlalu dekat */
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px; /* Lebar maksimal untuk form */
            min-height: 400px;
        }
        .form-section h3 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .form-section p {
            margin-bottom: 30px;
            font-size: 14px;
        }
        /* Input fields style */
        .form-section .form-control {
            border-radius: 10px;
            height: 50px;
            margin-bottom: 20px;
            width: 425px; /* Lebarkan input field agar mengikuti lebar form */
        }
        .form-section .btn-primary {
            border-radius: 10px;
            width: 100%;
            height: 45px;
            font-size: 16px;
        }
        .form-section .help-link {
            text-align: right;
            margin-top: 10px;
            font-size: 12px;
        }
        /* Footer */
        .footer {
            background-color: #e0e0e0;
            text-align: center;
            padding: 10px;
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <!-- Header -->
        <div class="header">
            <h1>Atma Hospital</h1>
        </div>
        
        <!-- Main Content -->
        <div class="content">
            <!-- Left Image Section -->
            <div class="image-section"></div>
            
            <!-- Right Form Section -->
            <div class="form-section">
                @yield('content')
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <div class="footer">
        &copy; 2024 Atma Hospital. All rights reserved.
    </div>
</body>
</html>