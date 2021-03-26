<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableSolicitacaoPodaRefac extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitacao_poda', function (Blueprint $table) {
            $table->dropColumn(['imagem1', 'imagem2', 'imagem3']);
            $table->enum('tipo_solicitacao', ['poda', 'retirada'])
                ->after('id')->nullable();
        });

        Schema::rename('solicitacao_poda', 'solicitacao_poda_retirada');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('solicitacao_poda_retirada', function (Blueprint $table) {
            DB::statement("ALTER TABLE solicitacao_poda ADD imagem1 MEDIUMBLOB");
            DB::statement("ALTER TABLE solicitacao_poda ADD imagem2 MEDIUMBLOB");
            DB::statement("ALTER TABLE solicitacao_poda ADD imagem3 MEDIUMBLOB");

            $table->dropColumn(['tipo_solicitacao']);
        });

        Schema::rename('solicitacao_poda_retirada', 'solicitacao_poda');
    }
}
