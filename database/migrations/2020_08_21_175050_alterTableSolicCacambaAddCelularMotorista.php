<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableSolicCacambaAddCelularMotorista extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('solicitacoes_cacambas', function(Blueprint $table)
        {
            $table->string('celular_motorista')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('solicitacoes_cacambas', function(Blueprint $table)
        {
            $table->dropColumn('celular_motorista');
        });
    }
}
