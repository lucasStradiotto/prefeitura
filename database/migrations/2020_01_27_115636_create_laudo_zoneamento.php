<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaudoZoneamento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laudo_zoneamento', function (Blueprint $table) {
            $table->increments('id');
            $table->string('zoneamento_nome');
            $table->string('usuario_login');
            $table->integer('logradouro_id');
            $table->integer('bairro_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laudo_zoneamento');
    }
}
