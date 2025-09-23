<?php

namespace Database\Seeders;

use App\Models\Persona;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PersonaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $persona = new Persona();
        $persona->name = "Usuario";
        $persona->surnames = "General";
        $persona->imagen = "medico.jpg";
        $persona->identificacion = "DNI";
        $persona->nro_identificacion = "00000000";
        $persona->tipo_persona = "General";
        $persona->slug = Str::slug($persona->nro_identificacion);
        $persona->sede_id = 1;
        $persona->save();

        $persona = new Persona();
        $persona->name = "Vitasur";
        $persona->surnames = "Administrador - General";
        $persona->imagen = "medico.jpg";
        $persona->identificacion = "DNI";
        $persona->nro_identificacion = "00000000";
        $persona->tipo_persona = "General";
        $persona->slug = Str::slug($persona->nro_identificacion);
        $persona->sede_id = 1;
        $persona->save();
    }
}
