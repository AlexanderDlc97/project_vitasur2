<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    protected $table = 'cajas';
    protected $fillable = [
        'name',
        'slug',
        'sede_id',
        'total_cuenta_banco',
        'total_efectivo',
        'total'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sede()
    {
        return $this->belongsTo(Sede::class);
    }
}
