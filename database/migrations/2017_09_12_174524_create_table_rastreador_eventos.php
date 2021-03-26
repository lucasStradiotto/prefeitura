<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRastreadorEventos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rastreador_eventos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rastreador_id');
            $table->dateTime('data_hora');
            $table->string('latitude');
            $table->string('longitude');
            $table->tinyInteger('basculando');
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
        Schema::dropIfExists('rastreador_eventos');
    }
}
