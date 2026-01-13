<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
    protected $table = 'vendedor'; // 👈 TU TABLA REAL
    protected $primaryKey = 'id';
    public $timestamps = false; // si no tienes created_at / updated_at

    protected $fillable = [
        'nombres',
        'email',
        // agrega otros campos reales si existen
    ];
}
