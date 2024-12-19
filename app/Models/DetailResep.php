<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailResep extends Model
{
    protected $table = 'detail_resep';
    public $timestamps = false;
    
    protected $fillable = [
        'id_resep',
        'id_obat',
        'dosis',
        'frekuensi',
        'jumlah'
    ];

    public function resep()
    {
        return $this->belongsTo(Resep::class, 'id_resep');
    }

    public function obat()
    {
        return $this->belongsTo(Obat::class, 'id_obat');
    }
}