<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AltNotificacaoEmpresaAddUsuarioId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notificacoes_empresas', function(Blueprint $table)
        {
            $table->integer('usuario_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notificacoes_empresas', function(Blueprint $table)
        {
            $table->dropColumn('usuario_id');
        });
    }
}
