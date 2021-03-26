<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterLogDeleteAbastecimentosTipoCombustivelString extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('log_delete_abastecimentos', function (Blueprint $table) {
            $table->string('tipo_combustivel')->change()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('log_delete_abastecimentos', function (Blueprint $table) {
            $table->integer('tipo_combustivel')->change()->nullable();
        });
    }
}
