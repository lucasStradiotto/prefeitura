<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRastreadorUltimoTempo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rastreador_ultimo_tempo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rastreador_id')->unique();
            $table->dateTime('data_rastreamento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rastreador_ultimo_tempo');
    }
}
