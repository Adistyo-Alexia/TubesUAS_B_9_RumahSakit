<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    protected $table = 'dokter';
    
    protected $fillable = [
        'id_pengguna',
        'spesialisasi',
        'deskripsi',
        'status'
    ];

    // Relasi ke tabel pengguna
    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna');
    }
}