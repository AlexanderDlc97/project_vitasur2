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
        Schema::create('detallepagos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_compra')->nullable();
            $table->string('concepto');
            $table->decimal('total', 8,2)->nullable();
            $table->decimal('pagado', 8,2)->nullable();
            $table->decimal('por_pagar', 8,2)->nullable();
            $table->decimal('monto_destinado', 8,2)->nullable();
            $table->string('boucher')->nullable();
            $table->decimal('valor', 8,2)->nullable();
            $table->decimal('igv', 8,2)->nullable();
            $table->string('cantidad')->nullable();
            $table->string('observaciones')->nullable();
            $table->unsignedBigInteger('pago_id');
            $table->foreign('pago_id')->references('id')->on('pagos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detallepagos');
    }
};
