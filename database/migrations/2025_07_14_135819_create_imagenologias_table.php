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
        Schema::create('imagenologias', function (Blueprint $table) {
            $table->id();
            $table->string('nro_solicitud')->nullable();
            $table->string('slug')->nullable();
            $table->string('motivo')->nullable();
            $table->date('fecha_imagenologia')->nullable(); 
            $table->text('descripcion_imagenologia')->nullable();
            $table->text('id_paciente')->nullable();
            $table->text('paciente')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imagenologias');
    }
};
