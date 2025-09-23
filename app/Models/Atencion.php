<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Atencion extends Model
{
    protected $table = 'atencions';
    protected $fillable = [
        'codigo',
        'slug',
        'tipo',
        'fecha',
        'hora',
        'duracion',
        'paciente_id',
        'especialidad_id',
        'medico_id',
        'descripcion',
        'estado',
        'registrado_por'
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
    public function cita()
    {
        return $this->belongsTo(Cita::class);
    }
}
