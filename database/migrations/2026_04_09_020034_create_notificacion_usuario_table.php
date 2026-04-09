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
        Schema::create('notificacion_usuario', function (Blueprint $table) {
            $table->uuid('id_notificacion');
            $table->uuid('id_usuario');
            $table->primary(['id_notificacion', 'id_usuario']);
            $table->timestamps();

            $table->foreign('id_notificacion')->references('id_notificacion')->on('notificacion')->cascadeOnDelete();
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notificacion_usuario');
    }
};
