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
        Schema::create('detallecobros', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_venta')->nullable();
            $table->string('concepto');
            $table->decimal('total', 8,2)->nullable();
            $table->decimal('cobrado', 8,2)->nullable();
            $table->decimal('por_cobrar', 8,2)->nullable();
            $table->decimal('monto_recibido', 8,2)->nullable();
            $table->decimal('valor', 8,2)->nullable();
            $table->decimal('igv', 8,2)->nullable();
            $table->string('cantidad')->nullable();
            $table->string('observaciones')->nullable();
            $table->unsignedBigInteger('cobro_id');
            $table->foreign('cobro_id')->references('id')->on('cobros');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detallecobros');
    }
};
