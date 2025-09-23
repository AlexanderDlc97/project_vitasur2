<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rx extends Model
{
    use HasFactory;
    protected $table = 'rxs';
    
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
