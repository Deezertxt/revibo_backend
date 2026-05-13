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
            $table->integer('distancia')->nullable();
            $table->integer('tiempo')->nullable();
            $table->string('origen_nombre')->nullable();
            $table->decimal('origen_lat', 10, 7)->nullable();
            $table->decimal('origen_lng', 10, 7)->nullable();
            $table->string('destino_nombre')->nullable();
            $table->decimal('destino_lat', 10, 7)->nullable();
            $table->decimal('destino_lng', 10, 7)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ruta', function (Blueprint $table) {
            $table->dropColumn(['distancia', 'tiempo', 'origen_nombre', 'origen_lat', 'origen_lng', 'destino_nombre', 'destino_lat', 'destino_lng']);
        });
    }
};
