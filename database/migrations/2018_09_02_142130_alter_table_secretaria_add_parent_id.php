<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableSecretariaAddParentId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('secretarias', function (Blueprint $table) {
            $table->unsignedInteger('parent_id')->nullable()->after('horario_programado_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('secretarias', function (Blueprint $table) {
            $table->dropColumn('parent_id');
        });
    }
}
