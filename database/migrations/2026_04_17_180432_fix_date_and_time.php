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
        Schema::table('reporte', function (Blueprint $table) {
            $table->dateTimeTz('fecha_inicio')->nullable()->change();
            $table->dateTimeTz('fecha_fin')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reporte', function (Blueprint $table) {
            $table->timestamp('fecha_inicio')->nullable(false)->change();
            $table->timestamp('fecha_fin')->nullable(false)->change();
        });
    }
};
