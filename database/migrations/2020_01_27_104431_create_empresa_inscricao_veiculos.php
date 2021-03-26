<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresaInscricaoVeiculos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresa_inscricao_veiculos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inscricao_id');
            $table->string('placa')->nullable();
            $table->integer('ano')->nullable();
            $table->string('veic_modelo')->nullable();
            $table->string('tipo')->nullable();
            $table->string('especie')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresa_inscricao_veiculos');
    }
}
