<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    protected $table = 'resep';
    public $timestamps = false;
    
    protected $fillable = [
        'id_konsultasi',
        'tanggal_resep',
        'catatan',
        'status'
    ];

    public function konsultasi()
    {
        return $this->belongsTo(Konsultasi::class, 'id_konsultasi');
    }

    public function detailResep()
    {
        return $this->hasMany(DetailResep::class, 'id_resep');
    }
}