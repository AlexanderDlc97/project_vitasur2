<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cobros', function (Blueprint $table) {
            $table->id();
            $table->string('nro_operacion');
            $table->string('slug');
            $table->string('tipo_transaccion');
            $table->dateTime('fecha');
            $table->string('tipo_moneda');
            $table->string('cliente');
            $table->string('ingreso');
            $table->string('cuentabanco_id')->nullable();
            $table->string('medio_pago');
            $table->decimal('subtotal', 8,2);
            $table->decimal('igv', 8,2)->default('0');
            $table->decimal('total_cobrado', 8,2)->nullable();
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
     */
    public function down(): void
    {
        Schema::dropIfExists('cobros');
    }
};
