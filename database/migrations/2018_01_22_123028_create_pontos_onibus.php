<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePontosOnibus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pontos_onibus', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rota_id')->unsigned();
            $table->string('latitude');
            $table->string('longitude');
            $table->integer('ordem_pontos');
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
        Schema::dropIfExists('pontos_onibus');
    }
}
