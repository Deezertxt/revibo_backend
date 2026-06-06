<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('ruta', function (Blueprint $table) {
            $table->dropForeign(['id_usuario']);
            $table->foreign('id_usuario')
                ->references('id_usuario')
                ->on('usuario')
                ->onDelete('cascade');
        });

        Schema::table('busqueda', function (Blueprint $table) {
            $table->dropForeign(['id_usuario']);
            $table->foreign('id_usuario')
                ->references('id_usuario')
                ->on('usuario')
                ->onDelete('cascade');
        });

        Schema::table('reporte', function (Blueprint $table) {
            $table->dropForeign(['id_usuario']);
            $table->foreign('id_usuario')
                ->references('id_usuario')
                ->on('usuario')
                ->onDelete('cascade');
        });

        Schema::table('device_tokens', function (Blueprint $table) {
            $table->dropForeign(['id_usuario']);
            $table->foreign('id_usuario')
                ->references('id_usuario')
                ->on('usuario')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ruta', function (Blueprint $table) {
            $table->dropForeign(['id_usuario']);
            $table->foreign('id_usuario')
                ->references('id_usuario')
                ->on('usuario');
        });

        Schema::table('busqueda', function (Blueprint $table) {
            $table->dropForeign(['id_usuario']);
            $table->foreign('id_usuario')
                ->references('id_usuario')
                ->on('usuario');
        });

        Schema::table('reporte', function (Blueprint $table) {
            $table->dropForeign(['id_usuario']);
            $table->foreign('id_usuario')
                ->references('id_usuario')
                ->on('usuario');
        });

        Schema::table('device_tokens', function (Blueprint $table) {
            $table->dropForeign(['id_usuario']);
            $table->foreign('id_usuario')
                ->references('id_usuario')
                ->on('usuario');
        });
    }
};
