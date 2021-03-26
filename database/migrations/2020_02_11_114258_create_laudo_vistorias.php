<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaudoVistorias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laudo_vistorias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sync_id');
            $table->integer('inscricao_id');
            $table->integer('laudo_situacao_id');
            $table->date('data_prevista');
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
        Schema::dropIfExists('laudo_vistorias');
    }
}
