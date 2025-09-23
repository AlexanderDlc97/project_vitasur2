<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Farmacia extends Model
{
    protected $table = 'farmacias';
    protected $fillable = [
        'codigo',
        'slug',
        'fecha',
        'tipo_atencion',
        'atencion',
        'descripcion',
        'subtotal',
        'igv',
        'total',
        'estado',
        'sede_id'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
