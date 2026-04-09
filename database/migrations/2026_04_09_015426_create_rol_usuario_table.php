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
        Schema::create('rol_usuario', function (Blueprint $table) {
            $table->uuid('id_rol');
            $table->uuid('id_usuario');
            $table->primary(['id_rol', 'id_usuario']);

            $table->timestamps();

            $table->foreign('id_rol')->references('id_rol')->on('rol')->cascadeOnDelete();
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rol_usuario');
    }
};
