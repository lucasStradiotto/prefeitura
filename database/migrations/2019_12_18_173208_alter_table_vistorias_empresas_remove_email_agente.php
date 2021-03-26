<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableVistoriasEmpresasRemoveEmailAgente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vistorias_empresas', function (Blueprint $table) {
            $table->dropColumn('email', 'agente');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vistorias_empresas', function (Blueprint $table) {
            $table->string('email')->nullable();
            $table->string('agente')->nullable();
        });
    }
}
