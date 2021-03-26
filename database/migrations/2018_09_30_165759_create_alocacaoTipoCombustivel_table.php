<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlocacaoTipoCombustivelTable extends Migration
{
    public function up()
    {
        Schema::create('alocacaoTipoCombustivel', function (Blueprint $table) {
            $table->increments('id');
            $table->string('veiculoId');
            $table->string('tipoCombustivelId');
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
        Schema::dropIfExists('alocacaoTipoCombustivel');
    }
}
