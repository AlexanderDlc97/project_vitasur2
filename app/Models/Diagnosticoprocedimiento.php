<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diagnosticoprocedimiento extends Model
{
    protected $table = 'diagnostico_procedimiento';
    protected $fillable = [
        'diagnostico_id',
        'procedimiento_id',
        'tipo',
        'caso',
        'alta'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function diagnostico()
    {
        return $this->belongsTo(Diagnostico::class);
    }

}
