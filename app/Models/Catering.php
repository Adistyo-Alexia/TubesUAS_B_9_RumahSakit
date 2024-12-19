<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catering extends Model
{
    protected $table = 'paket_katering';
    public $timestamps = false;

    protected $fillable = [
        'id_layanan',
        'nama',
        'deskripsi',
        'detail_menu',
        'durasi',
    ];
}