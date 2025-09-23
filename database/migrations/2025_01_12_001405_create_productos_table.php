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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('slug');
            $table->string('name');
            $table->string('imagen')->nullable();
            $table->string('name_generico')->nullable();
            $table->decimal('precio_compra', 11,2)->nullable();
            $table->decimal('precio_venta', 11,2);
            $table->string('marca');
            $table->string('unidad_medida');
            $table->integer('cantidad')->nullable();
            $table->longText('descripcion')->nullable();
            $table->string('estado');
            $table->string('registrado_por')->nullable();
            $table->unsignedBigInteger('clasificacion_id')->nullable();
            $table->foreign('clasificacion_id')->references('id')->on('clasificacions');
            $table->string('tipo_producto');
            $table->unsignedBigInteger('sede_id');
            $table->foreign('sede_id')->references('id')->on('sedes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicamentos');
    }
};
