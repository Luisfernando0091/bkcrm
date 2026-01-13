<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jefe extends Model
{
    use HasFactory;

    protected $table = 'jefe';

    protected $primaryKey = 'id';

    public $timestamps = true; // porque tienes created_at y updated_at

    protected $fillable = [
        'nombres',
        'email',
        'password',
        'telefono',
        'dni',
        'img_jefe',
        'id_equipo',
        'id_nivel_usuario',
        'estado_registro',
        'ruta_imagen_foto',
        'nombre_foto'
    ];

    protected $hidden = [
        'password' // 🔐 nunca devolver password en API
    ];
}
