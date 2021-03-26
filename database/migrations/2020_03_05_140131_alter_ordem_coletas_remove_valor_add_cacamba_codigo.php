<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterOrdemColetasRemoveValorAddCacambaCodigo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ordem_coletas', function (Blueprint $table) {
            $table->integer('codigo_cacamba')->nullable()->after('data_finalizada');
            $table->dropColumn(['valor']);
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
            $table->double('valor')->nullable()->after('data_finalizada');
            $table->dropColumn(['codigo_cacamba']);
        });
    }
}
