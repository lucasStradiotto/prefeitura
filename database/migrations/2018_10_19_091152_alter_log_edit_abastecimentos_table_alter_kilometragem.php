<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterLogEditAbastecimentosTableAlterKilometragem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('log_edit_abastecimentos', function (Blueprint $table) {
            $table->integer('kilometragem')->change()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('log_edit_abastecimentos', function (Blueprint $table) {
            $table->float('kilometragem')->change()->nullable();
        });
    }
}
