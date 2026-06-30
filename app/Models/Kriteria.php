<?php

namespace App\Models;

use App\Models\Penilaian;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    protected $fillable = [
        'kode_kriteria',
        'nama_kriteria',
        'sifat',
        'bobot'
    ];

    protected $casts = [
        'bobot' => 'float',
        'sifat' => 'string',
    ];

    public function penilaian() {
        return $this->hasMany(Penilaian::class);
    }
}
