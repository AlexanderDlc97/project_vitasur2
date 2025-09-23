<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    protected $table = 'especialidads';
    protected $fillable = [
        'codigo',
        'name',
        'slug',
        'costo',
        'profesione_id',
        'estado'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function profesione()
    {
        return $this->belongsTo(Profesion::class);
    }
}
