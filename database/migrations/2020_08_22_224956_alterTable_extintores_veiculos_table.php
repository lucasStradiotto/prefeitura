<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableExtintoresVeiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('extintores_veiculos', function (Blueprint $table) {
            $table->foreign('veiculo_id')->references('id')->on('veiculos');
            $table->foreign('extintor_id')->references('id')->on('extintores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
