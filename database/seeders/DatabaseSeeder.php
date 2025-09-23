<?php

namespace Database\Seeders;

use App\Models\Antecedente_patologico;
use App\Models\Clasificacion;
use App\Models\Especialidad;
use App\Models\Medico;
use App\Models\Persona;
use App\Models\Profesion;
use App\Models\Recurso_terapeutico;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call(SedeTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(ProfesionTableSeeder::class);
        $this->call(IdentificacionTableSeeder::class);
        $this->call(EspecialidadTableSeeder::class);
        $this->call(ClasificacionTableSeeder::class);
        $this->call(PersonaTableSeeder::class);
        $this->call(MedicoTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(BancoTableSeeder::class);
        $this->call(MediopagoTableSeeder::class);
        $this->call(TipocuentaTableSeeder::class);
        $this->call(CajaTableSeeder::class);
        $this->call(AntecedentepatologicoTableSeeder::class);
        $this->call(RecursoterapeuticoTableSedder::class);
        $this->call(HabitonocivoTableSedder::class);

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
