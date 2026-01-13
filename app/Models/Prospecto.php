<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserProspecto;   // ✅ AGREGA ESTA LÍNEA
use App\Models\Certificado;   // arriba del archivo
use App\Models\Sexo;
use App\Models\TipoDocumento;
use App\Models\CanalDigital;
use App\Models\Conclusiones;

class Prospecto extends Model
{
    use HasFactory;

    // Aquí le dices el nombre exacto de tu tabla
    protected $table = 'prospecto';

    protected $fillable = [
        'email',
        'tipo_documento_id',
        'id_productos',
        'id_canales',
        'fecha_registro',
        'id_estado_prospecto',
        'id_user_register',
        'id_vendedor_atencion',
        'fecha_creacion',
        'img_prospecto',
        'nombre_archivo1',
        'archivo1',
        'nombre_archivo2',
        'archivo2',
        'id_visita',
        'tipo_usuario',
        'reasignaciones',
        'id_certificado',
        'id_certificado_pro21',
        'fecha_proxima_cita',
        'revisado',
        'visita1',
        'fechavisita1',
        'fechaproximacita_visita1',
        'visita2',
        'fechavisita2',
        'fechaproximacita_visita2',
        'visita3',
        'fechavisita3',
        'fechaproximacita_visita3',
        'visita4',
        'fechavisita4',
        'fechaproximacita_visita4',
        'cantidadvisitas',
        'propio',
        'supervisor_id',
        'estado_eliminacion',
        'pausado_temporalmente',
        'codigo_calendario',
    ];

    protected $casts = [
        'propio' => 'boolean',
        'estado_eliminacion' => 'boolean',
        'pausado_temporalmente' => 'boolean',
        'revisado' => 'boolean',
        'fecha_registro' => 'datetime',
        'fecha_creacion' => 'date',
        'fecha_proxima_cita' => 'date',
        'fechavisita1' => 'datetime',
        'fechaproximacita_visita1' => 'datetime',
        'fechavisita2' => 'datetime',
        'fechaproximacita_visita2' => 'datetime',
        'fechavisita3' => 'datetime',
        'fechaproximacita_visita3' => 'datetime',
        'fechavisita4' => 'datetime',
        'fechaproximacita_visita4' => 'datetime',
    ];


    use HasFactory;

    // Relación con el modelo Producto
    public function producto()
    {
        return $this->belongsTo(Productos::class, 'id_productos', 'id');
    }
  

        public function userProspecto()
        {
            return $this->hasOne(UserProspecto::class, 'prospecto_id', 'id');
        }


        //1 crear relación con certificados
        public function certificado()
            {
                return $this->belongsTo(Certificados::class, 'id_certificado', 'id');
            }



        
        public function tipoDocumento()
            {
                return $this->belongsTo(TipoDocumento::class, 'tipo_documento_id', 'id');
            }




    // 👇 RELACIÓN CORRECTA
    public function canalDigital()
    {
        return $this->belongsTo(CanalDigital::class, 'id_canales', 'id');
    }



    public function conclusion()
    {
        return $this->belongsTo(
            Conclusiones::class,
            'id_estado_prospecto', // FK en prospecto
            'id'                   // PK en conclusiones
        );
    }

           public function vendedor(){
        return $this->belongsTo(Vendedor::class, 'id_vendedor_atencion', 'id');
           }
}


