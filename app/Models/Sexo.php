<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sexo extends Model
{
    protected $table = 'sexo';   // 👈 nombre real de la tabla
    protected $primaryKey = 'id';
    public $timestamps = false; // si no tienes created_at / updated_at
}
