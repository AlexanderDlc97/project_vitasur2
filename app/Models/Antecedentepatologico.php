<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Antecedentepatologico extends Model
{
    protected $table = 'antecedentes_patologicos';
    protected $fillable = ['name','estado'];

}
