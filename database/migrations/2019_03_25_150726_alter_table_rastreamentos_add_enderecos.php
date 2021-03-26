<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableRastreamentosAddEnderecos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rastreamentos', function (Blueprint $table) {
            $table->string('rua')->after('longitude')->nullable();
            $table->string('cidade')->after('rua')->nullable();
            $table->string('estado')->after('cidade')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rastreamentos', function (Blueprint $table) {
            $table->dropColumn(['rua', 'cidade', 'estado']);
        });
    }
}
