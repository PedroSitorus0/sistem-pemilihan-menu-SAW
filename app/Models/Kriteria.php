<?php

namespace App\Models;

use App\Models\Penilaian;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
<<<<<<< HEAD
    protected $table = 'kriteria';
=======

    protected $table = 'kriteria';

>>>>>>> 51ec1d964b28b4854903968eba23444147c6d3cb
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
