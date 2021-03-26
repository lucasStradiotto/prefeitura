<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableInventarioArboreosAddTamanhoCopaArvoree extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventario_arboreos', function (Blueprint $table) {
            $table->string('tamanho_copa_arvore')->after('metodo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inventario_arboreos', function (Blueprint $table) {
            $table->dropColumn(['tamanho_copa_arvore']);
        });
    }
}
