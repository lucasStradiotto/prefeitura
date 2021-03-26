<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableVistoriasEmpresas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vistorias_empresas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('atividade_empresa');
            $table->integer('numero_funcionarios')->nullable();
            $table->string('email')->nullable();
            $table->string('obs')->nullable();
            $table->string('agente');
            $table->dateTime('data_hora');
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
        Schema::dropIfExists('vistorias_empresas');
    }
}
