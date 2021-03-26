<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableAbastecimentosAddCollumnDescricao extends Migration
{

    public function up()
    {
        {
            Schema::table('abastecimentos', function (Blueprint $table) {
                $table->string('descricao')->nullable();
            });
        }
    }

    public function down()
    {
        Schema::table('abastecimentos', function (Blueprint $table) {
            $table->dropColumn('descricao');
        });
    }
}
