<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCercasVeiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cercas_veiculos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('veiculo_id')->unsigned();
            $table->integer('cerca_id')->unsigned();
            $table->string('data_inicio');
            $table->string('data_fim');
            $table->integer('acao');
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
        Schema::dropIfExists('cercas_veiculos');
    }
}
