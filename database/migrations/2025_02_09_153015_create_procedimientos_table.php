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
        Schema::create('procedimientos', function (Blueprint $table) {
            $table->id();
            $table->string('nro_solicitud')->nullable();
            $table->string('slug')->nullable();
            $table->string('registro_dolor')->nullable();
            $table->longText('detalle_registro_dolor')->nullable();
            $table->longText('plan_trabajo')->nullable();
            $table->longText('informacion_adicional')->nullable();
            $table->string('resultado_atencion')->nullable();
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
        Schema::dropIfExists('procedimientos');
    }
};
