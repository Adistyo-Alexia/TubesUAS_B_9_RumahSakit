<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';
    
    // Tambahkan ini untuk memberitahu Laravel bahwa model ini tidak menggunakan timestamps
    public $timestamps = false;
    
    protected $fillable = [
        'id_pengguna',
        'id_layanan',
        'id_dokter',
        'tanggal_pesanan',
        'waktu_janji',
        'total_biaya',
        'status',
        'status_pembayaran',
        'metode_pembayaran',
        'kode_pembayaran'
    ];

    // Relasi-relasi tetap sama
    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna');
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'id_layanan');
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'id_dokter');
    }

    public function konsultasi()
    {
        return $this->hasOne(Konsultasi::class, 'id_pesanan');
    }
}