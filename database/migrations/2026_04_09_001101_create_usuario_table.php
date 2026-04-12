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
        DB::statement('CREATE EXTENSION IF NOT EXISTS "pgcrypto";');
        Schema::create('usuario', function (Blueprint $table) {
            $table->uuid('id_usuario')->primary()->default(DB::raw('gen_random_uuid()'));
            $table->uuid('id_institucion')->nullable();
            $table->string('nombre', 50)->nullable();
            $table->string('correo', 150)->nullable();
            $table->text('password')->nullable();
            $table->enum('rol', ['admin', 'usuario', 'autoridad'])->nullable();
            $table->boolean('estado')->nullable();
            $table->timestamps();

            $table->foreign('id_institucion')->references('id_institucion')->on('institucion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario');
    }
};
