<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCacambasAddStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cacambas', function (Blueprint $table) {
            $table->unsignedInteger('status_cacamba_id')->nullable()->after('empresa_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cacambas', function (Blueprint $table) {
            $table->dropColumn(['status_cacamba_id']);
        });
    }
}
