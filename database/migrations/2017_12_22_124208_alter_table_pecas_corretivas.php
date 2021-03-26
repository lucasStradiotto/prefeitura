<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablePecasCorretivas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pecas_corretivas', function (Blueprint $table) {
            $table->integer('codigo')->after('ordem_servico_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pecas_corretivas', function (Blueprint $table) {
            $table->dropColumn('codigo');
        });
    }
}
