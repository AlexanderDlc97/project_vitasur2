<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Habitonocivo extends Model
{
    protected $table = 'habitos_nocivos';
    protected $fillable = ['name','estado'];
}
