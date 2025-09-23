<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registrocaja extends Model
{
    use HasFactory;
    protected $table = 'registrocajas';
    protected $fillable = array('*');

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sede()
    {
        return $this->belongsTo(Sede::class);
    }
}
