<?php

namespace Database\Seeders;

use App\Models\Profesion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProfesionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $profesion = new Profesion();
        $profesion->name = "Medicina";
        $profesion->slug = Str::slug($profesion->name);
        $profesion->estado = "Activo";
        $profesion->save();
        
        $profesion = new Profesion();
        $profesion->name = "Enfermería";
        $profesion->slug = Str::slug($profesion->name);
        $profesion->estado = "Activo";
        $profesion->save();
    }
}
