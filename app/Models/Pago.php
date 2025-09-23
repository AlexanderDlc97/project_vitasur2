<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table = 'pagos';

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sede()
    {
        return $this->belongsTo(Sede::class);
    }
}
