<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exames', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');

            $table->integer('tipo_exame_id')->unsigned();
            $table->foreign('tipo_exame_id')
                ->references('id')
                ->on('tipo_exames');

            $table->integer('tipo_padroes_id')->unsigned();
            $table->foreign('tipo_padroes_id')
                ->references('id')
                ->on('tipo_padroes');

            $table->integer('padrao_esperado_id')->unsigned();
            $table->foreign('padrao_esperado_id')
                ->references('id')
                ->on('padroes');

            $table->integer('min_esperado_id')->unsigned();
            $table->foreign('min_esperado_id')
                ->references('id')
                ->on('padroes');

            $table->integer('max_esperado_id')->unsigned();
            $table->foreign('max_esperado_id')
                ->references('id')
                ->on('padroes');

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
        Schema::dropIfExists('exames');
    }
}
