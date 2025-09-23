<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimientocaja extends Model
{
    use HasFactory;
    protected $table = 'movimiento_cajas';

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
