<?php

namespace Database\Seeders;

use App\Models\Habitonocivo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HabitonocivoTableSedder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $habiton = new Habitonocivo();
        $habiton->name = "Tabaco";
        $habiton->save();

        $habiton = new Habitonocivo();
        $habiton->name = "Alcohol";
        $habiton->save();

        $habiton = new Habitonocivo();
        $habiton->name = "Drogas";
        $habiton->save();
    }
}
