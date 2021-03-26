<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableLogDeleteAbastecimentosAddDataAbastecimento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('log_delete_abastecimentos', function (Blueprint $table) {
            $table->dateTime('data_abastecimento')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('log_delete_abastecimentos', function (Blueprint $table) {
            $table->dropColumn('data_abastecimento');
        });
    }
}
