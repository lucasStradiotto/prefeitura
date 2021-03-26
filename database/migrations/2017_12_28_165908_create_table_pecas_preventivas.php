<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePecasPreventivas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pecas_preventivas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ordem_servico_id');
            $table->integer('codigo');
            $table->string('nome');
            $table->double('valor');
            $table->integer('qtd');

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
        Schema::dropIfExists('pecas_preventivas');
    }
}
