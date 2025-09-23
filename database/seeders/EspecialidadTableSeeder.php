<?php

namespace Database\Seeders;

use App\Models\Especialidad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EspecialidadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $especialidad = new Especialidad();
        $especialidad->name = "Medicina general";
        $especialidad->slug = Str::slug($especialidad->name);
        $especialidad->estado = "Activo";
        $especialidad->profesione_id = 1;
        $especialidad->save();

        $especialidad = new Especialidad();
        $especialidad->name = "Traumatologia";
        $especialidad->slug = Str::slug($especialidad->name);
        $especialidad->estado = "Activo";
        $especialidad->profesione_id = 1;
        $especialidad->save();

        $especialidad = new Especialidad();
        $especialidad->name = "Urologia";
        $especialidad->slug = Str::slug($especialidad->name);
        $especialidad->estado = "Activo";
        $especialidad->profesione_id = 1;
        $especialidad->save();

        $especialidad = new Especialidad();
        $especialidad->name = "Neumologia";
        $especialidad->slug = Str::slug($especialidad->name);
        $especialidad->estado = "Activo";
        $especialidad->profesione_id = 1;
        $especialidad->save();

        $especialidad = new Especialidad();
        $especialidad->name = "Cardiologia";
        $especialidad->slug = Str::slug($especialidad->name);
        $especialidad->estado = "Activo";
        $especialidad->profesione_id = 1;
        $especialidad->save();

        $especialidad = new Especialidad();
        $especialidad->name = "Terapia Fisica";
        $especialidad->slug = Str::slug($especialidad->name);
        $especialidad->estado = "Activo";
        $especialidad->profesione_id = 1;
        $especialidad->save();

        $especialidad = new Especialidad();
        $especialidad->name = "Examen auxiliar";
        $especialidad->slug = Str::slug($especialidad->name);
        $especialidad->estado = "Activo";
        $especialidad->profesione_id = 1;
        $especialidad->save();

        $especialidad = new Especialidad();
        $especialidad->name = "Rx";
        $especialidad->slug = Str::slug($especialidad->name);
        $especialidad->estado = "Activo";
        $especialidad->profesione_id = 1;
        $especialidad->save();
    }
}
