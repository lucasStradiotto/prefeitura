<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterVistoriasEmpresasAddLaudoId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vistorias_empresas', function (Blueprint $table) {
            $table->integer('laudo_id')->nullable();
            $table->text('assinatura')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vistorias_empresas', function (Blueprint $table) {
            $table->dropColumn(['laudo_id', 'assinatura']);
        });
    }
}
