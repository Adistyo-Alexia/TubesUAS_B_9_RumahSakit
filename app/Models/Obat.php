<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    protected $table = 'obat';
    public $timestamps = false;
    
    protected $fillable = [
        'nama',
        'deskripsi',
        'satuan',
    ];

    public function detailResep()
    {
        return $this->hasMany(DetailResep::class, 'id_obat');
    }
}