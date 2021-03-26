<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRastreadorAlertas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rastreador_alertas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rastreador_id');
            $table->dateTime('data_hora');
            $table->string('latitude');
            $table->string('longitude');
            $table->tinyInteger('desligado');
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
        Schema::dropIfExists('rastreador_alertas');
    }
}
