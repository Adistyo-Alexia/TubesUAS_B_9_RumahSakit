<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Konsultasi extends Model
{
    protected $table = 'konsultasi';
    public $timestamps = false;

    protected $fillable = [
        'id_pesanan',
        'id_dokter',
        'id_pasien',
        'tanggal_konsultasi',
        'keluhan',
        'diagnosa',
        'catatan',
        'status'
    ];

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'id_dokter');
    }

    public function pasien()
    {
        return $this->belongsTo(Pengguna::class, 'id_pasien');
    }

    public function resep()
    {
        return $this->hasOne(Resep::class, 'id_konsultasi');
    }
}
