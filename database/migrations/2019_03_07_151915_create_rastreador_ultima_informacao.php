<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRastreadorUltimaInformacao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rastreador_ultima_informacao', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rastreador_id')->unique();
            $table->dateTime('data_hora');
            $table->string('latitude');
            $table->string('longitude');
            $table->double('velocidade')->nullable();
            $table->double('tipo_alerta')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rastreador_ultima_informacao');
    }
}
