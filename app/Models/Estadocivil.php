<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoCivil extends Model
{
    protected $table = 'estado_civil';   // ⚠️ confirma nombre real
    protected $primaryKey = 'id';
    public $timestamps = false;
}
