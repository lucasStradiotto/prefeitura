<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableLogCartaoMestreAbastecimento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_cartao_mestre_abastecimento', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('abastecimento_id')->nullable();
            $table->integer('cartao_mestre_id')->nullable();
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
        Schema::dropIfExists('log_cartao_mestre_abastecimento');
    }
}
