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
        DB::statement('CREATE EXTENSION IF NOT EXISTS postgis WITH SCHEMA "extensions";');
        Schema::create('ruta', function (Blueprint $table) {
            $table->uuid('id_ruta')->primary()->default(DB::raw('gen_random_uuid()'));
            $table->uuid('id_usuario');
            $table->string('nombre', 100)->nullable();

            $table->timestamps();

            $table->foreign('id_usuario')->references('id_usuario')->on('usuario');
        });

        DB::statement('ALTER TABLE ruta ADD COLUMN geom extensions.geometry(LineString, 4326);');
        DB::statement('CREATE INDEX idx_ruta_geom ON ruta USING GIST (geom);');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ruta');
    }
};
