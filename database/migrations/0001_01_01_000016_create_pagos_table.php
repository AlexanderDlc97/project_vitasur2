<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->string('nro_operacion');
            $table->string('slug');
            $table->string('tipo_transaccion');
            $table->dateTime('fecha');
            $table->string('tipo_moneda');
            $table->string('proveedor');
            $table->string('egreso');
            $table->string('id_egreso')->nullable();
            $table->string('medio_pago');
            $table->decimal('subtotal', 8,2);
            $table->decimal('igv', 8,2)->nullable();
            $table->decimal('total_pagado', 8,2)->nullable();
            $table->text('descripcion')->nullable();
            $table->string('validar_notify')->default('0');
            $table->string('registrado_por');
            $table->unsignedBigInteger('sede_id');
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
        Schema::dropIfExists('pagos');
    }
}
