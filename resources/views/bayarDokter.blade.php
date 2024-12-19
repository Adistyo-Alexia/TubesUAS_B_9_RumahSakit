<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dokter at Home - Atma Hospital</title>
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

        .breadcrumb p {
            margin: 0;
            font-size: 14px;
        }

        .breadcrumb p strong {
            color: #003366;
        }

        .card {
            background-color: #003366; 
            color: white;
            border-radius: 8px;
            padding: 10px;
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
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .order-info h4 {
            font-weight: bold;
            margin-bottom: 20px;
            color: #003366; 
        }

        .order-info p {
            font-size: 18px;
        }

        .status {
            font-size: 16px;
            margin-bottom: 20px;
        }

        .status span {
            color: #003366;
            font-weight: bold;
        }

        .form-select {
            font-size: 16px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            width: 100%;
        }

        .form-select:focus {
            border-color: #003366;
            box-shadow: 0 0 5px rgba(0, 51, 102, 0.5);
        }

        .btn-primary {
            background-color: #003366;
            border-color: #003366;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 18px;
            width: 100%;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #002244;
        }

        .payment-method h4 {
            font-weight: bold;
            margin-bottom: 20px;
            color: #003366; 
        }

        .payment-options {
            display: flex;
            justify-content: space-between;
            position: relative;
        }

        .payment-options div {
            width: 48%;
        }

        .payment-options h5 {
            font-weight: bold;
            margin-bottom: 15px;
            color: #003366; 
        }

        .payment-options label {
            display: block;
            margin-bottom: 10px;
            font-size: 16px;
            cursor: pointer;
            color: #003366; 
        }

        .payment-options input[type="radio"] {
            margin-right: 10px;
        }

        .payment-code {
            background-color: #e1ecf7; 
            padding: 15px;
            margin-top: 20px;
            border-radius: 8px;
            text-align: center;
            border: 1px solid #c0d3f0; 
        }

        .payment-code h5 {
            font-weight: bold;
            color: #003366;
        }

        .payment-code p {
            font-size: 20px;
            font-weight: bold;
            color: #003366; 
        }

        .payment-button {
            text-align: center;
            margin-top: 30px;
        }

        .payment-button button {
            background-color: #c0c0c0;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 18px;
            border-radius: 8px;
            cursor: pointer;
        }

        .edit-order {
            margin-top: 10px;
            background-color: #003366; 
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 8px;
            text-align: center;
        }

        .edit-order:hover {
            background-color: #002244; 
        }

        .payment-method {
            border: 1px solid #c0d3f0; 
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
        <p>Beranda > Dokter at Home > <strong>Pembayaran</strong></p>
    </div>

    <div class="container">
        <div class="order-section">
            
            <div class="order-info">
                <h4>Dokter yang tersedia</h4>
                    <div class="doctor-info">
                            <img src="{{ asset($doctor['photo']) }}" 
                                alt="{{ $doctor['name'] }}" 
                                style="border-radius: 50%; width: 80px; height: 80px; margin-right: 15px;">
                            <div>
                                <p><strong>{{ $doctor['name'] }}</strong><br>{{ $doctor['specialization'] }} - {{ $doctor['specialization_detail'] }}</p>
                            </div>
                        </div>
                    <div class="status">Tersedia: <span>{{ $doctor['available_today'] ? 'Tersedia hari ini' : 'Tidak tersedia hari ini' }}</span></div>
                <select class="form-select">
                    <option selected disabled>Pilih Waktu</option>
                    <option value="09:00">09:00</option>
                    <option value="12:00">12:00</option>
                    <option value="14:00">14:00</option>
                    <option value="18:00">18:00</option>
                </select>
            </div>

            
            <div class="payment-method">
                <h4>Pilih Metode Pembayaran</h4>
                <div class="payment-options">
                    <!-- Transfer Bank -->
                    <div>
                        <h5>Transfer Bank</h5>
                        <label>
                            <input type="radio" name="payment_method" value="BRI" /> BRI
                        </label>
                        <label>
                            <input type="radio" name="payment_method" value="BNI" /> BNI
                        </label>
                        <label>
                            <input type="radio" name="payment_method" value="BCA" /> BCA
                        </label>
                        <label>
                            <input type="radio" name="payment_method" value="Mandiri" /> Mandiri
                        </label>
                    </div>

                    <!-- Divider -->
                    <div class="divider"></div>

                    <!-- E-Wallet -->
                    <div>
                        <h5>E-Wallet</h5>
                        <label>
                            <input type="radio" name="payment_method" value="DANA" /> DANA
                        </label>
                        <label>
                            <input type="radio" name="payment_method" value="OVO" /> OVO
                        </label>
                        <label>
                            <input type="radio" name="payment_method" value="GoPay" /> GoPay
                        </label>
                    </div>
                </div>

                <div class="payment-button">
                    <form action="{{ url('/bukti-pemesanan-dokter') }}" method="POST" id="paymentForm">
                        @csrf
                        <input type="hidden" name="id" value="{{ $doctor['id'] }}">
                        <input type="hidden" name="name" value="{{ $doctor['name'] }}">
                        <input type="hidden" name="specialization" value="{{ $doctor['specialization'] }}">
                        <input type="hidden" name="specialization_detail" value="{{ $doctor['specialization_detail'] }}">
                        <input type="hidden" name="photo" value="{{ $doctor['photo'] }}">
                        <input type="hidden" name="payment_method" id="paymentMethod">
                        <input type="hidden" name="appointment_time" id="appointmentTime">

                        <button type="submit" class="btn btn-primary" id="paymentButton" onclick="setPaymentData(event)">Lanjutkan Pembayaran</button>
                    </form>
                </div>
            </div>

            <script>
                    function setPaymentData(event) {
                        // Prevent form submission if validation fails
                        const selectedMethod = document.querySelector('input[name="payment_method"]:checked');
                        const selectedTime = document.querySelector('.form-select').value;

                        if (!selectedMethod) {
                            alert('Silakan pilih metode pembayaran terlebih dahulu.');
                            event.preventDefault();
                            return;
                        }

                        if (!selectedTime) {
                            alert('Silakan pilih waktu janji temu terlebih dahulu.');
                            event.preventDefault();
                            return;
                        }

                        // Set hidden input values for payment method and time
                        document.getElementById('paymentMethod').value = selectedMethod.value;
                        document.getElementById('appointmentTime').value = selectedTime;
                    }
            </script>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
