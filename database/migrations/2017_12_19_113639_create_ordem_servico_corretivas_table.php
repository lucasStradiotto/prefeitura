<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdemServicoCorretivasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordem_servico_corretivas', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('data_execucao');
            $table->string('horario_inicio');
            $table->string('horario_fim');
            $table->integer('veiculo_id');
            $table->string('descricao');
            $table->string('servico');
            $table->string('ferramenta')->nullable();
            $table->double('valor_total');
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
        Schema::dropIfExists('ordem_servico_corretivas');
    }
}
