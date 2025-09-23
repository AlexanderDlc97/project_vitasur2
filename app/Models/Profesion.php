<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profesion extends Model
{
    protected $table = 'profesions';
    protected $fillable = [
        'name',
        'slug',
        'estado',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
