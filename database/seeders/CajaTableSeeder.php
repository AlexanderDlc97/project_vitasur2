<?php

namespace Database\Seeders;

use App\Models\Caja;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CajaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $caja = new Caja();
        $caja->name_caja = "Caja Principal";
        $caja->slug = Str::slug($caja->name_caja);
        $caja->sede_id = 1;
        $caja->total_efectivo = "0";
        $caja->total_cuenta_banco = "0";
        $caja->total = "0";
        $caja->estado = "Cerrada";
        $caja->save();

        // $caja = new Caja();
        // $caja->name_caja = "Caja 2";
        // $caja->slug = Str::slug($caja->name_caja.'-'.'2');
        // $caja->sede_id = 2;
        // $caja->total_efectivo = "0";
        // $caja->total_cuenta_banco = "0";
        // $caja->total = "0";
        // $caja->save();

    }
}
