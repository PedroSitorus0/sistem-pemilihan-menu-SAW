<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemLog extends Model
{
    protected $fillable = [
        'user_id',
        'method',
        'url',
        'ip_andress',
        'user_agent',
    ];

    protected $casts = [
        'user_id' => 'integer',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
