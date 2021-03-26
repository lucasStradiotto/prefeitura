<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGedObservacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ged_observacoes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('ged_id');
            $table->string('nome_observacao');
            $table->string('valor_observacao');
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
        Schema::dropIfExists('ged_observacoes');
    }
}
