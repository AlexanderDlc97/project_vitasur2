<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'codigo',
        'name',
        'slug',
        'estado'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function diagnosticos()
    {
        return $this->hasMany(Diagnostico::class);
    }
}
