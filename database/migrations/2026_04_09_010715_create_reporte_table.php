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
        Schema::create('reporte', function (Blueprint $table) {
            $table->uuid('id_reporte')->primary()->default(DB::raw('gen_random_uuid()'));
            $table->uuid('id_usuario');
            $table->uuid('id_tipo_reporte');
            $table->uuid('id_gravedad_reporte');
            $table->string('titulo',100)->nullable();
            $table->string('descripcion',550)->nullable();
            $table->geometry('geom', 'geometry', 4326)->nullable();
            $table->boolean('activo')->nullable();
            $table->timestamp('fecha_inicio')->nullable();
            $table->timestamp('fecha_fin')->nullable();
            $table->timestamp('fecha_actualizacion')->nullable();

            $table->foreign('id_usuario')->references('id_usuario')->on('usuario');
            $table->foreign('id_tipo_reporte')->references('id_tipo_reporte')->on('tipo_reporte');
            $table->foreign('id_gravedad_reporte')->references('id_gravedad_reporte')->on('gravedad_reporte');
        });

        //DB::statement('ALTER TABLE reporte ADD COLUMN geom extensions.geometry(Point, 4326);');
        DB::statement('CREATE INDEX idx_reporte_geom ON reporte USING GIST (geom);');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reporte');
    }
};
