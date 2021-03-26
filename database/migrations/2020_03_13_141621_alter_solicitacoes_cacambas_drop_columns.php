<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSolicitacoesCacambasDropColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitacoes_cacambas', function (Blueprint $table) {
            $table->dropColumn(['bairro_id_cobranca', 'rua_id_cobranca', 'numero_cobranca']);
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
            $table->unsignedInteger('bairro_id_cobranca')->nullable();
            $table->unsignedInteger('rua_id_cobranca')->nullable();
            $table->string('numero_cobranca')->nullable();
        });
    }
}
