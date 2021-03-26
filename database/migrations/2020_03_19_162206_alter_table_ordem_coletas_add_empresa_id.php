<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableOrdemColetasAddEmpresaId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ordem_coletas', function (Blueprint $table) {
            $table->unsignedInteger('empresa_id')->nullable()->after('codigo_cacamba');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ordem_coletas', function (Blueprint $table) {
            $table->dropColumn('empresa_id');
        });
    }
}
