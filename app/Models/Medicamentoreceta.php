<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicamentoreceta extends Model
{
    protected $table = 'medicamento_receta';
    protected $fillable = [
        'medicamento_id',
        'receta_id',
        'via',
        'cantidad',
        'indicaciones'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
