<?php

namespace Database\Seeders;

use App\Models\Recursoterapeutico;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecursoterapeuticoTableSedder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $recursot = new Recursoterapeutico();
        $recursot->name = "Compresas humedas o clientes";
        $recursot->save();

        $recursot = new Recursoterapeutico();
        $recursot->name = "Compresas frias";
        $recursot->save();

        $recursot = new Recursoterapeutico();
        $recursot->name = "Infrarrojo";
        $recursot->save();

        $recursot = new Recursoterapeutico();
        $recursot->name = "Parafina";
        $recursot->save();

        $recursot = new Recursoterapeutico();
        $recursot->name = "Electroterapia";
        $recursot->save();

        $recursot = new Recursoterapeutico();
        $recursot->name = "Ultrasonido";
        $recursot->save();

        $recursot = new Recursoterapeutico();
        $recursot->name = "Terapia combinada";
        $recursot->save();

        $recursot = new Recursoterapeutico();
        $recursot->name = "Magnetoterapia";
        $recursot->save();

        $recursot = new Recursoterapeutico();
        $recursot->name = "Laserterapia";
        $recursot->save();
    }
}
