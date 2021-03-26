<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SolicitacoesCacambas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitacoes_cacambas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('celular_solicitante')->nullable();
            $table->integer('empresa_id')->nullable();
            $table->boolean('aceito')->nullable();
            $table->date('data_solicitacao')->nullable();
            $table->date('data_aceitacao')->nullable();
            $table->string('telefone')->nullable();
            $table->string('bairro')->nullable();
            $table->string('rua')->nullable();
            $table->string('numero')->nullable();
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
        Schema::dropIfExists('solicitacoes_cacambas');
    }
}
