<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterOrdemColetasAddIdEvento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ordem_coletas', function (Blueprint $table) {
            $table->unsignedInteger('evento_entrega_id')->nullable()->after('data_entrega');
            $table->unsignedInteger('evento_retirada_id')->nullable()->after('data_retirada');
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
            $table->dropColumn(['evento_entrega_id', 'evento_retirada_id']);
        });
    }
}
