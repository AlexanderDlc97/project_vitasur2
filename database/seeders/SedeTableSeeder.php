<?php

namespace Database\Seeders;

use App\Models\Sede;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SedeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sede = new Sede();
        $sede->name = "Central Chincha";
        $sede->slug = Str::slug($sede->name);
        $sede->direccion = "Prolongacion Lima 711";
        $sede->referencia = "URB. Arboleda";
        $sede->estado = "Activo";
        $sede->departamento_id= "11";
        $sede->imagen = "NULL";
        $sede->nro_contacto = "984 346 738 / 972 374 072";
        $sede->save();
    }
}
