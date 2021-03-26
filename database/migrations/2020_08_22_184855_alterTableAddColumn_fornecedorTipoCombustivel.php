<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableAddColumnFornecedorTipoCombustivel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fornecedor_tipo_combustivels', function (Blueprint $table) {
            $table->integer('posto_id')->unsigned()->change();
            $table->foreign('posto_id')->references('id')->on('postos_de_gasolinas')->onDelete('cascade');
            $table->integer('tipo_combustivel_id')->unsigned()->change();
            $table->foreign('tipo_combustivel_id')->references('id')->on('tipo_combustivels')->onDelete('cascade');
            $table->string('valor_unitario')->nullable()->after('tipo_combustivel_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fornecedor_tipo_combustivels', function (Blueprint $table) {
            $table->dropForeign(['posto_id','tipo_combustivel_id']);
        });
    }
}
