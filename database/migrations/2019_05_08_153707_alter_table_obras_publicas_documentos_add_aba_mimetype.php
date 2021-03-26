<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableObrasPublicasDocumentosAddAbaMimetype extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('obras_publicas_documentos', function (Blueprint $table) {
            $table->string('aba')->after('caminho')->nullable();
            $table->string('mime_type')->after('aba')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('obras_publicas_documentos', function (Blueprint $table) {
            $table->dropColumn(['aba', 'mime_type']);
        });
    }
}
