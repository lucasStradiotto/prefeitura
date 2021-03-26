<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableDespesaSetoresAddSecretariaId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('despesa_setores', function (Blueprint $table) {
            $table->unsignedInteger('secretaria_id')->after('nome')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('despesa_setores', function (Blueprint $table) {
            $table->dropColumn('secretaria_id');
        });
    }
}
