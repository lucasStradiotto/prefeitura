<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableProtocolosSetfieldstonull extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('protocolos', function (Blueprint $table) {
            $table->string('numero')->nullable()->change();
            $table->string('status')->nullable()->change();
            $table->string('assunto')->nullable()->change();
            $table->string('comodos')->nullable()->change();
            $table->string('proprietario')->nullable()->change();
            $table->string('setor')->nullable()->change();
            $table->string('quadra')->nullable()->change();
            $table->string('lote')->nullable()->change();
            $table->boolean('dt')->nullable()->change();
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
            $table->string('numero')->change();
            $table->string('status')->change();
            $table->string('assunto')->change();
            $table->string('comodos')->change();
            $table->string('proprietario')->change();
            $table->string('setor')->change();
            $table->string('quadra')->change();
            $table->string('lote')->change();
            $table->boolean('dt')->change();
        });
    }
}
