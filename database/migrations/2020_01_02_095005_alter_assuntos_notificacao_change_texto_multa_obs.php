<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAssuntosNotificacaoChangeTextoMultaObs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::table('assuntos_notificacao', function (Blueprint $table) {
            $table->renameColumn('texto_multa_obs', 'capitulacao');
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /*Schema::table('assuntos_notificacao', function (Blueprint $table) {
            $table->renameColumn('capitulacao', 'texto_multa_obs');
        });*/
    }
}
