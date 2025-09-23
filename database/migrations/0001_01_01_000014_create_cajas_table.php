<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCajasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cajas', function (Blueprint $table) {
            $table->id();
            $table->string('name_caja');
            $table->string('slug');
            $table->decimal('total_cuenta_banco', 8,2)->default('0.00')->nullable();
            $table->decimal('total_efectivo', 8,2)->default('0.00')->nullable();
            $table->string('total', 8,2)->default('0.00')->nullable();
            $table->string('estado')->nullable();
            $table->unsignedBigInteger('sede_id');
            $table->foreign('sede_id')->references('id')->on('sedes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cajas');
    }
}
