<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    protected $table = 'medicos';
    protected $fillable = [
        'persona_id',
        'profesion_id',
        'cmp',
        'estado'
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

    public function profesion()
    {
        return $this->belongsTo(Profesion::class);
    }
}
