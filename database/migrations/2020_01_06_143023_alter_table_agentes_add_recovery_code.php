<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableAgentesAddRecoveryCode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agentes', function (Blueprint $table) {
            $table->string('recovery_code')->after('senha')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agentes', function (Blueprint $table) {
            $table->dropColumn('recovery_code');
        });
    }
}
