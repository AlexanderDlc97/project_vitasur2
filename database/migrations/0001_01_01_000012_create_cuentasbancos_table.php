<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuentasbancosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuentasbancos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('nro_cuenta');
            $table->string('nro_cuenta_cci');
            $table->string('estado');
            $table->decimal('apertura_cuenta',11,2)->default(0);
            $table->string('registrado_por');
            $table->unsignedBigInteger('sede_id');
            $table->unsignedBigInteger('tipocuenta_id');
            $table->unsignedBigInteger('banco_id');
            $table->foreign('sede_id')->references('id')->on('sedes');
            $table->foreign('tipocuenta_id')->references('id')->on('tipocuentas')->onDelete('cascade');
            $table->foreign('banco_id')->references('id')->on('bancos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cuentasbancos');
    }
}
