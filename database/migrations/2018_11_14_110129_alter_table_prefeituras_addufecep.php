<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablePrefeiturasAddufecep extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prefeituras', function (Blueprint $table) {
            $table->string('uf')->nullable()->after('cidade');
            $table->string('cep')->nullable()->after('endereco');
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
            $table->dropColumn('uf');
            $table->dropColumn('cep');
        });
    }
}
