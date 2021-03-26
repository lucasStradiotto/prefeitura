<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablePrefeiturasAddSiteCaixapostal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prefeituras', function (Blueprint $table) {
            $table->string('site')->after('telefone')->nullable();
            $table->string('caixa_postal')->after('cep')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prefeituras', function (Blueprint $table) {
            $table->dropColumn(['site', 'caixa_postal']);
        });
    }
}
