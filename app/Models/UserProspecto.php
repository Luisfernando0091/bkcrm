<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProspecto extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'user_prospecto';

    // Campos que pueden ser asignados masivamente
    protected $fillable = [
        'prospecto_id', 
        'id_estado_civil', 
        'fecha_nacimiento', 
        'id_sexo', 
        'id_departamento', 
        'id_provincia', 
        'id_distrito', 
        'telef_domicilio', 
        'telef_oficina', 
        'celular', 
        'direccion_prospecto', 
        'numero_documento', 
        'urbanizacion', 
        'referencia', 
        'ocupacion', 
        'nombres', 
        'ubigeo', 
        'id_usuario_creador', 
        'estado_eliminacion'
    ];

    // Relación con la tabla Prospecto
    public function prospecto()
    {
        return $this->belongsTo(Prospecto::class, 'prospecto_id');
    }

    // Relación con la tabla Estado Civil
    // public function estadoCivil()
    // {
    //     return $this->belongsTo(EstadoCivil::class, 'id_estado_civil');
    // }

    // Relación con la tabla Sexo
    // public function sexo()
    // {
    //     return $this->belongsTo(Sexo::class, 'id_sexo');
    // }

    // Relación con la tabla Departamento
    // public function departamento()
    // {
    //     return $this->belongsTo(Departamento::class, 'id_departamento');
    // }

    // Relación con la tabla Provincia
    // public function provincia()
    // {
    //     return $this->belongsTo(Provincia::class, 'id_provincia');
    // }

    // Relación con la tabla Distrito
    // public function distrito()
    // {
    //     return $this->belongsTo(Distrito::class, 'id_distrito');
    // }

    // Relación con el Usuario Creador
    public function usuarioCreador()
    {
        return $this->belongsTo(User::class, 'id_usuario_creador');
    }

    // Buscar UserProspecto por prospecto_id
// public function getByProspectoId($prospectoId)
// {
//     $userProspecto = UserProspecto::where('prospecto_id', $prospectoId)->firstOrFail();
//     return response()->json($userProspecto);
// }
public function sexo()
{
    return $this->belongsTo(Sexo::class, 'id_sexo', 'id');
}







public function estadocivil()
{
    return $this->belongsTo(Estadocivil::class, 'id_estado_civil', 'id');
}


}
