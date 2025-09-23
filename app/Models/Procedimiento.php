<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Procedimiento extends Model
{
    protected $table = 'procedimientos';
    protected $fillable = [
        'nro_solicitud',
        'slug',
        'registro_dolor',
        'detalle_registro_dolor',
        'plan_trabajo',
        'informacion_adicional',
        'resultado_atencion',
        'atencion_id'
    ];
}
