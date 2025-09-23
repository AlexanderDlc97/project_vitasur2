<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $table = 'consultas';
    protected $fillable = [
        'nro_solicitud',
        'slug',
        'fecha',
        'gestando',
        'otros',
        'antecedentes',
        'anamnesis',
        'presion_arterial_uno',
        'presion_arterial_dos',
        'frecuencia_cardiaca',
        'temperatura_corporal',
        'presion_venosa_central',
        'Frecuencia_respiratoria',
        'sat_o2',
        'peso',
        'talla',
        'imc',
        'perimetro_abdominal',
        'tratamiento',
        'interconsulta',
        'motivo_interconsulta',
        'solicitud_interconsulta',
        'sesiones_programadas',
        'frecuencia_sesiones',
        'pulsos_perifericos',
        'aparato_respiratorio',
        'abdomen',
        'extremidades',
        'electro_cardiograma',
        'riesgo_quirurgico',
        'atencion_id'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function antecedentes_patologicos()
    {
        return $this->belongsToMany(Antecedentepatologico::class);
    }
    public function habitos_nocivos()
    {
        return $this->belongsToMany(Habitonocivo::class);
    }
    public function recursos_terapeuticos()
    {
        return $this->belongsToMany(Recursoterapeutico::class);
    }
}
