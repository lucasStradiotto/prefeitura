<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableSolicitacaoCacambasRefactorColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitacoes_cacambas', function (Blueprint $table) {
            $table->renameColumn('bairro', 'bairro_id_obra');
            $table->renameColumn('rua', 'rua_id_obra');
            $table->renameColumn('numero', 'numero_obra');
        });

        Schema::table('solicitacoes_cacambas', function (Blueprint $table) {
            $table->unsignedInteger('tipo_entulho_id')->after('usuario_id')->nullable();
            $table->unsignedInteger('bairro_id_cobranca')->after('bairro_id_obra')->nullable();
            $table->unsignedInteger('rua_id_cobranca')->after('rua_id_obra')->nullable();
            $table->unsignedInteger('numero_cobranca')->after('numero_obra')->nullable();
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
            $table->renameColumn('bairro_id_obra', 'bairro');
            $table->renameColumn('rua_id_obra', 'rua');
            $table->renameColumn('numero_obra', 'numero');
        });

        Schema::table('solicitacoes_cacambas', function (Blueprint $table) {
            $table->dropColumn(['tipo_entulho_id', 'bairro_id_cobranca', 'rua_id_cobranca', 'numero_cobranca']);
        });
    }
}
