<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificados extends Model
{
    protected $table = 'certificados';
    protected $fillable = [
            'certificados',
            'Cuota',
            
    ];
}
