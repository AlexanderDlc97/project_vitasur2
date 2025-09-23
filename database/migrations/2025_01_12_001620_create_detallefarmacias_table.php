<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallefarmaciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detallefarmacias', function (Blueprint $table) {
            $table->id();
            $table->string('id_medicamento');
            $table->string('codigo');
            $table->string('medicamento');
            $table->string('umedida');
            $table->string('cantidad');
            $table->decimal('precio', 11,2);
            $table->decimal('subtotal', 11,2);
            $table->unsignedBigInteger('farmacia_id');
            $table->foreign('farmacia_id')->references('id')->on('farmacias')->onDelete('cascade');
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
        Schema::dropIfExists('detallefarmacias');
    }
}
