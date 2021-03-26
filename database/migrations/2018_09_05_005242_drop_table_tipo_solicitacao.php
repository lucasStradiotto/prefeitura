<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropTableTipoSolicitacao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('tipo_solicitacao');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('tipo_solicitacao', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->integer('prazo');
            $table->timestamps();
        });
    }
}
