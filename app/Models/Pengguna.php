<?php

// app/Models/Pengguna.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    protected $table = 'pengguna';
    
    protected $fillable = [
        'nama',
        'nama_pengguna',
        'no_telepon',
        'email',
        'kata_sandi',
        'jenis_kelamin',
        'alamat',
        'url_foto',
        'peran'
    ];

}