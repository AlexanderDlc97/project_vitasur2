<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Procedimientoclinico extends Model
{
    protected $table = 'procedimientos_clinicos';
    protected $fillable = [
        'name',
        'slug',
        'tipo',
        'costo',
        'estado'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
