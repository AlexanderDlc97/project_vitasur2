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
        Schema::create('detalleeauxiliares', function (Blueprint $table) {
            $table->id();
            $table->string('analisis');
            $table->string('t_analisis');
            $table->unsignedBigInteger('eauxiliares_id');
            $table->foreign('eauxiliares_id')->references('id')->on('eauxiliares')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalleeauxiliares');
    }
};
