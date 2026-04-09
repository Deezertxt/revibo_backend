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
        Schema::create('busqueda', function (Blueprint $table) {
            $table->uuid('id_busqueda')->primary()->default(DB::raw('gen_random_uuid()'));
            $table->uuid('id_usuario');
            $table->string('termino_busqueda');
            
            $table->timestamps();
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario');
        });

        DB::statement('ALTER TABLE busqueda ADD COLUMN geom geometry(Point, 4326);');
        DB::statement('CREATE INDEX idx_busqueda_geom ON busqueda USING GIST (geom);');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('busqueda');
    }
};
