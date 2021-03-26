<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSolicitacoesCacambasCodigoCacambaChange extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitacoes_cacambas', function (Blueprint $table) {
            $table->integer('codigo_cacamba')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('solicitacoes_cacambas', function (Blueprint $table) {
            $table->float('codigo_cacamba')->nullable()->change();
        });
    }
}
