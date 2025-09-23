<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrocajasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrocajas', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('slug');
            $table->string('fecha_apertura');
            $table->string('hora_apertura');
            $table->string('fecha_cierre')->nullable();
            $table->string('hora_cierre')->nullable();
            $table->string('saldo_inicial');
            $table->decimal('saldo_ingreso', 8,2)->default('0.00')->nullable();
            $table->decimal('saldo_egreso', 8,2)->default('0.00')->nullable();
            $table->string('estado')->default('APERTURADA');
            $table->string('registrado_por');
            $table->unsignedBigInteger('caja_id');
            $table->unsignedBigInteger('sede_id');
            $table->foreign('caja_id')->references('id')->on('cajas');
            $table->foreign('sede_id')->references('id')->on('sedes');
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
        Schema::dropIfExists('registrocajas');
    }
}
