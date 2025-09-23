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
        Schema::create('consulta_recursoterapeutico', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('consulta_id');
            $table->unsignedBigInteger('recursoterapeutico_id');

            $table->foreign('consulta_id')->references('id')->on('consultas')->onDelete('cascade');

            $table->foreign('recursoterapeutico_id')->references('id')->on('recursos_terapeuticos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atencion_recursoterapeutico');
    }
};
