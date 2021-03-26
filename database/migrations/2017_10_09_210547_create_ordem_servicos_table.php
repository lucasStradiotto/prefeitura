<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdemServicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordem_servicos', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('data_execucao');
            $table->dateTime('data_prevista');
            $table->string('horario_inicio');
            $table->string('horario_fim');
            $table->integer('veiculo_id');
            $table->integer('preventiva_id');
            $table->string('descricao');
            $table->string('servico');
            $table->string('ferramenta')->nullable();

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
        Schema::dropIfExists('ordem_servicos');
    }
}
