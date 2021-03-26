<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVistoriaEmpresaPonto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vistoria_empresa_ponto', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('vistoria_id')->nullable();
            $table->string('descricao')->nullable();
            $table->string('tipo')->nullable();
            $table->string('especie')->nullable();
            $table->string('logradouro')->nullable();
            $table->string('bairro')->nullable();
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
        Schema::dropIfExists('vistoria_empresa_ponto');
    }
}
