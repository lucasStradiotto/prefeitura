<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableOrdemColetasRemoveColumnsAddLatlng extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ordem_coletas', function (Blueprint $table) {
            $table->dropColumn(['rg', 'evento_retirada_id', 'evento_entrega_id']);
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
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
            $table->string('rg')->nullable();
            $table->unsignedInteger('evento_entrega_id')->nullable();
            $table->unsignedInteger('evento_retirada_id')->nullable();
            $table->dropColumn(['lat', 'lng']);
        });
    }
}
