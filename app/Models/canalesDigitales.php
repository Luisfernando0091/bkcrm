<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CanalDigital extends Model
{
    protected $table = 'canales';

    protected $fillable = [
        'canal',
    ];
}
