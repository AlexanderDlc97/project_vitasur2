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
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('slug');
            $table->date('fecha');
            $table->time('hora');
            $table->integer('duracion');
            $table->unsignedBigInteger('paciente_id');
            $table->unsignedBigInteger('especialidad_id');
            $table->unsignedBigInteger('medico_id');
            $table->unsignedBigInteger('sede_id');
            $table->longText('descripcion')->nullable();
            $table->string('estado');
            $table->string('registrado_por')->nullable();
            $table->foreign('paciente_id')->references('id')->on('pacientes');
            $table->foreign('especialidad_id')->references('id')->on('especialidads');
            $table->foreign('medico_id')->references('id')->on('medicos');
            $table->foreign('sede_id')->references('id')->on('sedes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
