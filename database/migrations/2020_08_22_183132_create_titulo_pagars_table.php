<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTituloPagarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('titulo_pagars', function (Blueprint $table) {
            $table->increments('id');
            // $table->unsignedBigInteger('veiculoId');
            // $table->foreign('veiculoId')->references ('id')-> on ('veiculos');
            $table->integer('ano');
            $table->dateTime('vencDPVA');
            $table->dateTime('vencIPVA');
            $table->dateTime('vencLicenciamento');
            $table->decimal('valorIPVA');
            $table->decimal('valorDPVA');
            $table->decimal('valorLicenciamento');
            $table->string('status');
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
       Schema::dropIfExists('titulo_pagars');
    }
}
