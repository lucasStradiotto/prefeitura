<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableDocumentosGeradosAddfields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('documentos_gerados', function (Blueprint $table) {
            $table->string('pagina')->nullable()->after('data_emissao');
            $table->string('livro')->nullable()->after('pagina');
            $table->date('data_inicio')->nullable()->after('livro');
            $table->date('data_fim')->nullable()->after('data_inicio');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('documentos_gerados', function (Blueprint $table) {
            $table->dropColumn('pagina');
            $table->dropColumn('livro');
            $table->dropColumn('data_inicio');
            $table->dropColumn('data_fim');
        });
    }
}
