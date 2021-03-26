<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVeiculosMotoristasTable extends Migration
{

    public function up()
    {
        Schema::create('veiculos_motoristas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('veiculo_id');
            $table->integer('motorista_id');
            $table->dateTime('data_utilizacao');

            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('veiculos_motoristas');
    }
}
