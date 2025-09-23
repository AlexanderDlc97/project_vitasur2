<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    protected $fillable = [
        'codigo',
        'slug',
        'name',
        'name_generico',
        'precio_compra',
        'precio_venta',
        'marca',
        'cantidad',
        'estado',
        'descripcion',
        'clasificacion_id',
        'tipo_producto'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function clasificacion()
    {
        return $this->belongsTo(Clasificacion::class);
    }
}
