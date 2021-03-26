<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropResultadosPreventivasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('resultados_preventivas');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('resultados_preventivas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('preventiva_id');
            $table->dateTime('data');

            $table->timestamps();
        });
    }
}
