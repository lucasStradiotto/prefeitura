<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterEmpresaInscricoesAddEstabelecido extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::table('empresa_inscricoes', function (Blueprint $table) {
            $table->boolean('estabelecido')->nullable();
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /*Schema::table('empresa_inscricoes', function (Blueprint $table) {
            $table->dropColumn('estabelecido');
        });*/
    }
}
