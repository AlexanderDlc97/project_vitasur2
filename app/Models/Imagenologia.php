<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imagenologia extends Model
{
    //
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
