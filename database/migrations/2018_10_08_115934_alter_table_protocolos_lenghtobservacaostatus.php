<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableProtocolosLenghtobservacaostatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('protocolos', function (Blueprint $table) {
            $table->string('observacaoStatus', 1000)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('protocolos', function (Blueprint $table) {
            $table->string('observacaoStatus', 191)->nullable()->change();
        });
    }
}
