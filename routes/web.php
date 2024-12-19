<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\ResepController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\CateringController;
use Illuminate\Http\Request;

$adminCredentials = [
    'no_telepon' => '082233344455',
    'password' => 'adminpassword'
];

$dokterCredentials = [
    'no_telepon' => '082298877665',
    'password' => 'dokterpassword'
];

Route::get('/', function () {
    return view('login');
});

Route::get('/masuk', function () {
    return view('masuk');
});

Route::get('/register', function () {
    return view('register');
});

Route::post('/check-phone', function (Request $request) use ($adminCredentials, $dokterCredentials) {
    $phone = $request->input('phone');
    
    if ($phone === $adminCredentials['no_telepon'] || $phone === $dokterCredentials['no_telepon']) {
        return redirect('/masuk')->with('phone', $phone);
    }
    
    $penggunaController = new PenggunaController();
    $pengguna = $penggunaController->getPenggunaByPhone($phone);
    
    if ($pengguna) {
        return redirect('/masuk')->with('phone', $phone);
    }
    
    return redirect('/register')->with('phone', $phone);
});

Route::post('/proses-login', function (Request $request) use ($adminCredentials, $dokterCredentials) {
    $phone = $request->input('phone');
    $password = $request->input('password');

    if ($phone === $adminCredentials['no_telepon'] && $password === $adminCredentials['password']) {
        session(['user_role' => 'admin']);
        return redirect('/admin-dashboard');
    }

    if ($phone === $dokterCredentials['no_telepon'] && $password === $dokterCredentials['password']) {
        session(['user_role' => 'dokter']);
        return redirect('/konsultasi');
    }

    $penggunaController = new PenggunaController();
    $pengguna = $penggunaController->getPenggunaByPhone($phone);

    if ($pengguna && password_verify($password, $pengguna->kata_sandi)) {
        session([
            'user_id' => $pengguna->id,
            'user_role' => 'pengguna'
        ]);
        return redirect('/home');
    }

    return back()->with('error', 'Password salah!');
});

Route::post('/proses-register', function (Request $request) {
    // Validasi input
    $request->validate([
        'phone'    => 'required|numeric|digits_between:10,15|unique:pengguna,no_telepon',
        'email'    => 'required|email|unique:pengguna,email',
        'username' => 'required|unique:pengguna,nama_pengguna',
        'password' => 'required|min:6|confirmed'
    ]);

    // Panggil method createPengguna di PenggunaController
    $penggunaController = new PenggunaController();
    $penggunaController->createPengguna([
        'username' => $request->username,
        'phone'    => $request->phone, // Ambil dari input
        'email'    => $request->email,
        'password' => $request->password
    ]);

    // Redirect ke halaman login dengan pesan sukses
    return redirect('/')->with('success', 'Registrasi berhasil! Silakan login.');
});

Route::get('/logout', function () {
    session()->flush();
    return redirect('/');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/admin-dashboard', [PenggunaController::class, 'index']);

Route::get('/profile-admin', function () {
    return view('profile_admin');
});
Route::get('/doctors-admin', [DokterController::class, 'index']);
Route::get('/tambah-dokter', [DokterController::class, 'create']);
Route::post('/dokter', [DokterController::class, 'store']);
Route::get('/edit-dokter/{id}', [DokterController::class, 'edit']);
Route::put('/dokter/{id}', [DokterController::class, 'update']);
Route::delete('/dokter/{id}', [DokterController::class, 'destroy']);

Route::get('/layanan-admin', [LayananController::class, 'index']);
Route::get('/tambah-layanan', [LayananController::class, 'create']);
Route::post('/layanan', [LayananController::class, 'store']);
Route::get('/edit-layanan/{id}', [LayananController::class, 'edit']);
Route::put('/layanan/{id}', [LayananController::class, 'update']);
Route::delete('/layanan/{id}', [LayananController::class, 'destroy']);

Route::get('/konsultasi', [KonsultasiController::class, 'index'])->name('konsultasi');
Route::get('/tambah-konsultasi', [KonsultasiController::class, 'create'])->name('tambah.konsultasi');
Route::post('/konsultasi', [KonsultasiController::class, 'store'])->name('konsultasi.store');
Route::get('/konsultasi/{id}/edit', [KonsultasiController::class, 'edit'])->name('konsultasi.edit');
Route::put('/konsultasi/{id}', [KonsultasiController::class, 'update'])->name('konsultasi.update');
Route::delete('/konsultasi/{id}', [KonsultasiController::class, 'destroy'])->name('konsultasi.destroy');

// Route untuk resep, sekarang parameter konsultasi_id menjadi opsional
Route::prefix('resep')->group(function () {
    Route::get('/create/{konsultasi_id?}', [ResepController::class, 'create'])->name('resep.create');
    Route::post('/', [ResepController::class, 'store'])->name('resep.store');
    Route::get('/{id}', [ResepController::class, 'show'])->name('resep.show');
});

Route::get('/selesai-konsultasi', function() {
    return view('selesai_konsultasi');
})->name('selesai.konsultasi');

Route::get('/dokter-home', function () {
    return view('dokterHome');
});

Route::get('/dokter-home', [DokterController::class, 'showDokterHome']);

Route::get('/bayar-dokter/{id}', function ($id) {
    $doctor = App\Models\Dokter::with('pengguna')->findOrFail($id);
    return view('bayarDokter', ['doctor' => $doctor]);
})->name('bayar.dokter');

Route::get('/bayar-dokter/{id}', [DokterController::class, 'showBayarDokter'])->name('bayar.dokter');
Route::post('/bukti-pemesanan-dokter', [DokterController::class, 'showBuktiPemesananDokter'])->name('bukti.pemesanan.dokter');

Route::get('/pusat', function () {
    return view('pusatInformasi'); // Pusat Informasi page
})->name('pusatInformasi');

Route::get('/detail-dokter/{id}', [PesananController::class, 'showDetailDokter'])->name('dokter.detail');
Route::post('/pesanan', [PesananController::class, 'store'])->name('pesanan.store');

Route::get('/bayar-dokter/{id}', [PesananController::class, 'showBayarDokter'])->name('bayar.dokter');

Route::get('/profile', function () {
    return view('profile');
});

// Menampilkan halaman edit profile
Route::get('/profile/edit', [PenggunaController::class, 'edit'])->name('profile.edit');

// Menyimpan hasil edit profile
Route::post('/profile/update', [PenggunaController::class, 'update'])->name('profile.update');

//show profile
Route::get('/profile', [PenggunaController::class, 'profile'])->name('profile');

//Riwayat
Route::get('/riwayat-transaksi', function() {
    return view('riwayat_transaksi_user');
});

//simpan Transaksi ke Riwayat
Route::post('/transaksi/dokter', [TransaksiController::class, 'storeTransaksiDokter'])->name('transaksi.storeDokter');

//tampilkan cari resep
Route::get('/cari-resep', function () {
    return view('cari_resep');
});

//search by id resep
Route::post('/cari-resep', [ResepController::class, 'cariResep'])->name('resep.cari');

//buka tampilan catering
Route::get('/catering', function () {
    return view('catering');
})->name('catering');

//show catering
Route::get('/catering', [LayananController::class, 'index2']);

Route::get('/detail/{id}', [LayananController::class, 'show'])->name('catering.detail');

//bayar catering
Route::get('/pembayaran/{id}', [LayananController::class, 'pembayaran'])->name('pembayaran');

Route::post('/pembayaran/{id}', [LayananController::class, 'pembayaran'])->name('pembayaran.proses');

Route::get('/catering', [CateringController::class, 'index'])->name('catering.index');
Route::get('/tambah-catering', [CateringController::class, 'create'])->name('tambah.catering');
Route::post('/catering', [CateringController::class, 'store'])->name('catering.store');
Route::get('/catering/{id}/edit', [CateringController::class, 'edit'])->name('catering.edit');
Route::put('/catering/{id}', [CateringController::class, 'update'])->name('catering.update');
Route::delete('/catering/{id}', [CateringController::class, 'destroy'])->name('catering.destroy');

Route::get('/catering-detail/{id}', function ($id) {
    return view('Cateringdetail', ['id' => $id]);
});

Route::get('/catering-detail/{id}', [CateringController::class, 'showCateringDetail']);

Route::get('/pembayaran/{id}', [CateringController::class, 'showPembayaran'])->name('pembayaran.show');

Route::post('/bukti', [CateringController::class, 'showBuktiPembayaran'])->name('bukti.pembayaran');



