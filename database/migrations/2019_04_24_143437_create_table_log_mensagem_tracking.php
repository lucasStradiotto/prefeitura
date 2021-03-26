<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableLogMensagemTracking extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_mensagem_tracking', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rastreador_id');
            $table->dateTime('data_hora');
            $table->integer('evento_multi_portal');
            $table->text('mensagem');
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
        Schema::dropIfExists('log_mensagem_tracking');
    }
}
