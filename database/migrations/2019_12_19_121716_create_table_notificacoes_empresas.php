<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableNotificacoesEmpresas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificacoes_empresas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('notificacao_modelo_id')->nullable();
            $table->unsignedInteger('vistoria_id')->nullable();
            $table->string('assunto_descricao', 1000)->nullable();
            $table->string('assunto_fundamento', 1000)->nullable();
            $table->string('assunto_objeto', 1000)->nullable();
            $table->string('assunto_observacao', 1000)->nullable();
            $table->string('assunto_providencia', 1000)->nullable();
            $table->string('assinatura')->nullable();
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
        Schema::dropIfExists('notificacoes_empresas');
    }
}
