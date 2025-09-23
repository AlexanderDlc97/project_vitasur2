<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'personas';
    protected $fillable = [
        'slug',
        'name',
        'surnames',
        'identificacion',
        'nro_identificacion',
        'imagen',
        'nro_contacto',
        'telefono',
        'fecha_cumple',
        'sexo',
        'estado_civil',
        'direccion',
        'referencia',
        'tipo_persona',
        'registrado_por',
        'sede_id'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function medico()
    {
        return $this->hasOne(Medico::class);
    }

    public function paciente()
    {
        return $this->hasOne(Paciente::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function sede()
    {
        return $this->belongsTo(Sede::class);
    }
}
