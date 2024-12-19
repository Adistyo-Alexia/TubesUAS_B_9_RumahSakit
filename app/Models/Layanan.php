<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $table = 'layanan';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'deskripsi',
        'harga',
        'kategori',
        'url_gambar',
        'status'
    ];

    public function paketKatering()
    {
        return $this->hasOne(PaketKatering::class, 'id_layanan');
    }
}