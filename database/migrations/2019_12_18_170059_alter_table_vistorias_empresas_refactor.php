<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableVistoriasEmpresasRefactor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vistorias_empresas', function (Blueprint $table) {
            $table->dropColumn('atividade_empresa', 'obs', 'data_hora');
        });
        Schema::table('vistorias_empresas', function (Blueprint $table) {
            $table->unsignedInteger('empresa_id')->after('id')->nullable();
            $table->unsignedInteger('agente_id')->after('empresa_id')->nullable();
            $table->timestamp('data_hora')->after('agente_id')->nullable();
            $table->string('nome_fantasia')->after('data_hora')->nullable();
            $table->string('cnpj')->after('nome_fantasia')->nullable();
            $table->string('inscricao')->after('cnpj')->nullable();
            $table->string('atividade', 2000)->after('inscricao')->nullable();
            $table->string('obs_vistoria', 2000)->after('numero_funcionarios');
            $table->boolean('gera_notificacao')->after('obs_vistoria');
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
            $table->dropColumn(['nome_fantasia', 'cnpj', 'inscricao', 'atividade',
                'obs_vistoria', 'gera_notificacao', 'data_hora', 'empresa_id', 'agente_id']);
        });
        Schema::table('vistorias_empresas', function (Blueprint $table) {
            $table->string('atividade_empresa')->nullable();
            $table->string('obs')->nullable();
            $table->dateTime('data_hora');
        });
    }
}
