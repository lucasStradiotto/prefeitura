<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbastecimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abastecimentos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('veiculo_id')->nullable();
            $table->string('motorista')->nullable();
            $table->string('tipo_combustivel')->nullable();
            $table->float('valor_unitario')->nullable();
            $table->float('litros')->nullable();
            $table->float('kilometragem')->nullable();
            $table->dateTime('data')->nullable();
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
        Schema::dropIfExists('abastecimentos');
    }
}
