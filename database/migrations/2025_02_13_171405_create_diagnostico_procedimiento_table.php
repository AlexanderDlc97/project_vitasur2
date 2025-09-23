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
        Schema::create('diagnostico_procedimiento', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('diagnostico_id');
            $table->unsignedBigInteger('procedimiento_id');
            $table->string('tipo')->nullable();
            $table->string('caso')->nullable();
            $table->string('alta')->nullable();
            $table->foreign('diagnostico_id')->references('id')->on('diagnosticos')->onDelete('cascade');
            $table->foreign('procedimiento_id')->references('id')->on('procedimientos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnostico_procedimiento');
    }
};
