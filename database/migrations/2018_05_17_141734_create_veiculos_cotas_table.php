<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVeiculosCotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('veiculos_cotas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('veiculo_id')->nullable();
            $table->double('cota_litros')->nullable();
            $table->dateTime('periodo_inicial')->nullabel();
            $table->dateTime('periodo_final')->nullabel();
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
        Schema::dropIfExists('veiculos_cotas');
    }
}
