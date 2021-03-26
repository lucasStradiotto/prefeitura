<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableLogEditAbastecimentosEditCollumnTipoCombustivel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('log_edit_abastecimentos', function (Blueprint $table) {
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
        Schema::table('log_edit_abastecimentos', function (Blueprint $table) {
            $table->integer('tipo_combustivel')->change()->nullable();
        });
    }
}
