<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreventivasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preventivas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('intervalo');
            $table->integer('veiculo_id');
            $table->integer('tipo_preventiva_id');
            $table->integer('unidade_intervalo_id');

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
        Schema::dropIfExists('preventivas');
    }
}
