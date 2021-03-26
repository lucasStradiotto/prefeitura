<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablePadroesAddTipoPadraoId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('padroes', function (Blueprint $table) {
            $table->integer('tipo_padrao_id')->unsigned();
            $table->foreign('tipo_padrao_id')
                ->references('id')
                ->on('tipo_padroes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('padroes', function (Blueprint $table) {
            $table->dropColumn('tipo_padrao_id');
        });
    }
}
