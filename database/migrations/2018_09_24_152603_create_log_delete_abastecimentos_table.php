<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogDeleteAbastecimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_delete_abastecimentos', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('data_exclusao')->nullable();
            $table->integer('abastecimento_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('veiculo_id')->nullable();
            $table->string('motorista')->nullable();
            $table->integer('tipo_combustivel')->nullable();
            $table->float('valor_unitario')->nullable();
            $table->float('litros')->nullable();
            $table->float('kilometragem')->nullable();
            $table->integer('posto_id')->nullable();
            $table->string('frentista')->nullable();
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
        Schema::dropIfExists('log_delete_abastecimentos');
    }
}
