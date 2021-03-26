<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVistoriaEmpresaVeiculo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vistoria_empresa_veiculo', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('vistoria_id')->nullable();
            $table->string('placa')->nullable();
            $table->string('tipo')->nullable();
            $table->string('especie')->nullable();
            $table->integer('ano')->nullable();
            $table->string('veic_modelo')->nullable();
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
        Schema::dropIfExists('vistoria_empresa_veiculo');
    }
}
