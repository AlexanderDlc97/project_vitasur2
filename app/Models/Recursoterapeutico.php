<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recursoterapeutico extends Model
{
    protected $table = 'recursos_terapeuticos';
    protected $fillable = ['name','estado'];
}
