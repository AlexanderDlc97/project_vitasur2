<?php

namespace Database\Seeders;

use App\Models\Antecedentepatologico;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AntecedentepatologicoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $antecedentep = new Antecedentepatologico();
        $antecedentep->name = "Hipertension";
        $antecedentep->save();

        $antecedentep = new Antecedentepatologico();
        $antecedentep->name = "Diabetes";
        $antecedentep->save();

        $antecedentep = new Antecedentepatologico();
        $antecedentep->name = "Dislipidemia";
        $antecedentep->save();

        $antecedentep = new Antecedentepatologico();
        $antecedentep->name = "Angina";
        $antecedentep->save();

        $antecedentep = new Antecedentepatologico();
        $antecedentep->name = "Cirugia";
        $antecedentep->save();

        $antecedentep = new Antecedentepatologico();
        $antecedentep->name = "Infecciones";
        $antecedentep->save();

        $antecedentep = new Antecedentepatologico();
        $antecedentep->name = "Arritmias";
        $antecedentep->save();

        $antecedentep = new Antecedentepatologico();
        $antecedentep->name = "Tiroides";
        $antecedentep->save();

        $antecedentep = new Antecedentepatologico();
        $antecedentep->name = "Quirurgicos";
        $antecedentep->save();

        $antecedentep = new Antecedentepatologico();
        $antecedentep->name = "Alergias";
        $antecedentep->save();
    }
}