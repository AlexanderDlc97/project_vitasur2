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
        Schema::create('consultas', function (Blueprint $table) {
            $table->id();
            $table->string('nro_solicitud')->nullable();
            $table->string('slug')->nullable();
            $table->string('gestando')->nullable();
            $table->text('otros')->nullable();
            $table->text('antecedentes')->nullable();
            $table->text('anamnesis')->nullable();
            $table->integer('presion_arterial_uno')->nullable();
            $table->integer('presion_arterial_dos')->nullable();
            $table->integer('frecuencia_cardiaca')->nullable();
            $table->decimal('temperatura_corporal', 11,2)->nullable();
            $table->integer('presion_venosa_central')->nullable();
            $table->integer('Frecuencia_respiratoria')->nullable();
            $table->integer('sat_o2')->nullable();
            $table->decimal('peso', 11,2)->nullable();
            $table->decimal('talla', 11,2)->nullable();
            $table->decimal('imc', 11,2)->nullable();
            $table->decimal('perimetro_abdominal', 11,2)->nullable();
            $table->text('pulsos_perifericos')->nullable();
            $table->text('aparato_respiratorio')->nullable();
            $table->text('abdomen')->nullable();
            $table->text('extremidades')->nullable();
            $table->text('electro_cardiograma')->nullable();
            $table->string('riesgo_quirurgico')->nullable();
            $table->string('sesiones_programadas')->nullable();
            $table->string('frecuencia_sesiones')->nullable();
            $table->text('tratamiento')->nullable();
            $table->string('interconsulta')->nullable();
            $table->text('motivo_interconsulta')->nullable();
            $table->text('solicitud_interconsulta')->nullable();
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
        Schema::dropIfExists('consultas');
    }
};
