<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ged', function (Blueprint $table) {
            $table->increments('id');
            $table->string('secretaria')->nullable();
            $table->dateTime('data')->nullable();
            $table->string('nome_usuario')->nullable();
            $table->string('nome_arquivo')->nullable();
            $table->string('caminho_arquivo')->nullable();
            $table->string('obs1')->nullable();
            $table->string('obs2')->nullable();
            $table->string('obs3')->nullable();
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
        Schema::dropIfExists('ged');
    }
}
