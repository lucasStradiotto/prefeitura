<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogResetSenhaFrentistasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_reset_senha_frentistas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('frentista_id');
            $table->integer('user_id');
            $table->dateTime('data_alteracao');
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
        Schema::dropIfExists('log_reset_senha_frentistas');
    }
}
