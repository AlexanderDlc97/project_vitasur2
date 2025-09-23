<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimientoCajasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimiento_cajas', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('slug');
            $table->string('motivo')->nullable();
            $table->string('asunto')->nullable();
            $table->string('paciente')->nullable();
            $table->string('total');
            $table->string('metodo');
            $table->string('operaciones')->nullable();
            $table->string('cuenta');
            $table->unsignedBigInteger('registrocaja_id');
            $table->foreign('registrocaja_id')->references('id')->on('registrocajas');
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
        Schema::dropIfExists('movimiento_cajas');
    }
}
