<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detallefarmacia extends Model
{
    protected $table = 'detallefarmacias';
    protected $fillable = [
        'id_medicamento',
        'codigo',
        'medicamento',
        'umedida',
        'cantidad',
        'precio',
        'subtotal',
        'farmacia_id'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
