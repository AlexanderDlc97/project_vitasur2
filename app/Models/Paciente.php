<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $table = 'pacientes';
    protected $fillable = [
        'ocupacion',
        'responsable',
        'historia_clinica',
        'estado',
        'persona_id'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}