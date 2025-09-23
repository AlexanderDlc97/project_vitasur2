<?php

namespace Database\Seeders;

use App\Models\Clasificacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ClasificacionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clasificacion = new Clasificacion();
        $clasificacion->name = "Tabletas";
        $clasificacion->slug = Str::slug($clasificacion->name);
        $clasificacion->estado = "Activo";
        $clasificacion->save();

        $clasificacion = new Clasificacion();
        $clasificacion->name = "Capsulas";
        $clasificacion->slug = Str::slug($clasificacion->name);
        $clasificacion->estado = "Activo";
        $clasificacion->save();

        $clasificacion = new Clasificacion();
        $clasificacion->name = "Polvo";
        $clasificacion->slug = Str::slug($clasificacion->name);
        $clasificacion->estado = "Activo";
        $clasificacion->save();

        $clasificacion = new Clasificacion();
        $clasificacion->name = "Soluciones orales";
        $clasificacion->slug = Str::slug($clasificacion->name);
        $clasificacion->estado = "Activo";
        $clasificacion->save();

        $clasificacion = new Clasificacion();
        $clasificacion->name = "Soluciones inyectables";
        $clasificacion->slug = Str::slug($clasificacion->name);
        $clasificacion->estado = "Activo";
        $clasificacion->save();
    }
}
