<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtintoresVeiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extintores_veiculos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('veiculo_id')->unsigned();
            $table->integer('extintor_id')->unsigned();
            $table->date('data_vigencia')->nullable();
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
        Schema::dropIfExists('extintores_veiculos');
    }
}
