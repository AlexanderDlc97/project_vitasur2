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
        Schema::create('eauxiliares', function (Blueprint $table) {
            $table->id();
            $table->string('nro_solicitud')->nullable();
            $table->string('slug')->nullable();
            $table->date('fecha_auxiliar')->nullable(); 
            $table->date('vfecha_auxiliar')->nullable();
            $table->string('estado_pago')->default('Pendiente');
            $table->unsignedBigInteger('atencion_id');
            $table->foreign('atencion_id')->references('id')->on('atencions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eauxiliares');
    }
};
