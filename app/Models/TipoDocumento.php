<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    protected $table = 'tipo_documento';

    protected $fillable = [
        'nombre' // DNI, RUC, PASAPORTE, etc.
    ];

    public $timestamps = false; // si tu tabla no tiene created_at
}
