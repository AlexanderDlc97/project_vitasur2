<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cobro extends Model
{
    use HasFactory;
    protected $table = 'cobros';

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sede()
    {
        return $this->belongsTo(Sede::class);
    }
}
