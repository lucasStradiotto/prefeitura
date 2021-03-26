<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostesEnergiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postes_energia', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('bairro_id');
            $table->unsignedInteger('rua_id');
            $table->integer('numero_casa');
            $table->timestamp('data');
            $table->string('nome_solicitante');
            $table->unsignedInteger('anomalia_id');
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
        Schema::dropIfExists('postes_energia');
    }
}
