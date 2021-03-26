<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCercasEletronica extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cercas_eletronicas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->integer('numero');
            $table->boolean('notificacao');
            $table->boolean('area_risco');
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
        Schema::dropIfExists('cercas_eletronicas');
    }
}
