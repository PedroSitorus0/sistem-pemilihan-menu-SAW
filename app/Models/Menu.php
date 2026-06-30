<?php

namespace App\Models;

use App\Models\Penilaian;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'nama_menu',
        'kategori',
        'harga',
        'deskripsi',
        'ketersediaan',
        'foto',
    ];

    protected $casts = [
        'harga' => 'integer',
        'ketersediaan' => 'string',
    ];

    public function penilaian() {
        return $this->hasMany(Penilaian::class);
    }

}
