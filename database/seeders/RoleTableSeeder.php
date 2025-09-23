<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = new Role();
        $role->name = "Administrador";
        $role->slug = Str::slug($role->name);
        $role->estado = "Activo";
        $role->save();

        $role = new Role();
        $role->name = "Médico";
        $role->slug = Str::slug($role->name);
        $role->estado = "Activo";
        $role->save();

        $role = new Role();
        $role->name = "Paciente";
        $role->slug = Str::slug($role->name);
        $role->estado = "Activo";
        $role->save();

        $role = new Role();
        $role->name = "Secretaria";
        $role->slug = Str::slug($role->name);
        $role->estado = "Activo";
        $role->save();

        $role = new Role();
        $role->name = "Farmaceutica";
        $role->slug = Str::slug($role->name);
        $role->estado = "Activo";
        $role->save();

        $role = new Role();
        $role->name = "Radiologo";
        $role->slug = Str::slug($role->name);
        $role->estado = "Activo";
        $role->save();
        
    }
}
