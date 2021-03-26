<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterOrdemServicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ordem_servicos', function (Blueprint $table) {
            DB::statement("ALTER TABLE ordem_servicos RENAME TO ordem_servico_preventivas");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ordem_servico_preventivas', function (Blueprint $table) {
            DB::statement("ALTER TABLE ordem_servico_preventivas RENAME TO ordem_servicos");
        });
    }
}
