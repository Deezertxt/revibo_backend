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
        Schema::create('url_imagen_reporte', function (Blueprint $table) {
            $table->uuid('id_url_imagen_reporte')->primary()->default(DB::raw('gen_random_uuid()'));
            $table->uuid('id_reporte');
            $table->text('url_imagen')->nullable();
            $table->timestamps();

            $table->foreign('id_reporte')->references('id_reporte')->on('reporte')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('url_imagen_reporte');
    }
};
