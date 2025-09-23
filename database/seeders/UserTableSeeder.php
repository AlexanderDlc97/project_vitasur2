<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->email = "admin@vitasur.com";
        $user->password = Hash::make("123");
        $user->estado = "Activo";
        $user->role_id = 1;
        $user->persona_id = 1;
        $user->save();

        $user = new User();
        $user->email = "usuario@vitasur.com";
        $user->password = Hash::make("123");
        $user->estado = "Activo";
        $user->role_id = 1;
        $user->persona_id = 2;
        $user->save();

    }
}
