<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cuentabancaria extends Model
{
    protected $table = 'cuentasbancos';
    protected $fillable = [
        'name',
        'slug',
        'nro_cuenta',
        'nro_cuenta_cci',
        'tipocuenta_id',
        'banco_id',
        'estado',
        'apertura_cuenta'
    ];
    
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function tipocuenta()
    {
        return $this->belongsTo(Tipocuenta::class);
    }

    public function banco()
    {
        return $this->belongsTo(Banco::class);
    }

    public function sede()
    {
        return $this->belongsTo(Sede::class);
    }
}
