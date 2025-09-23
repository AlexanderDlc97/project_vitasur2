<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    protected $table = 'citas';
    protected $fillable = [
        'codigo',
        'slug',
        'fecha',
        'hora',
        'duracion',
        'paciente_id',
        'especialidad_id',
        'medico_id',
        'descripcion',
        'estado',
        'registrado_por',
        'sede_id'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function medico()
    {
        return $this->belongsTo(Medico::class);
    }

    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class);
    }
}
