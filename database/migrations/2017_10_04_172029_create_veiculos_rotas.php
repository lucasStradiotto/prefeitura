<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVeiculosRotas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('veiculos_rotas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome_rota');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('ordem_rota');
            $table->string('id_veiculo');
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
        Schema::dropIfExists('veiculos_rotas');
    }
}
