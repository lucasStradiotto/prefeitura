<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableLogInsertAbastecimentosManualChangetipocombustivel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('log_abastecimentos_manual', function (Blueprint $table) {
            $table->string('tipo_combustivel')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('log_abastecimentos_manual', function (Blueprint $table) {
            $table->integer('tipo_combustivel')->nullable()->change();
        });
    }
}
