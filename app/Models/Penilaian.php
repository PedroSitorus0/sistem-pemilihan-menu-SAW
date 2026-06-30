<?php

namespace App\Models;

use App\Models\Kriteria;
use App\Models\Menu;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    protected $fillable = [
        'menu_id',
        'kriteria_id',
        'user_id',
        'nilai',
    ];

    protected $casts = [
        'nilai' => 'float',
    ];

    public function menu() {
        return $this->belongsTo(Menu::class);
    }

    public function kriteria() {
        return $this->belongsTo(Kriteria::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

}
