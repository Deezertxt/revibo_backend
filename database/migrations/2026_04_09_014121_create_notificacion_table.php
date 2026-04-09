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
        Schema::create('notificacion', function (Blueprint $table) {
            $table->uuid('id_notificacion')->primary()->default(DB::raw('gen_random_uuid()'));
            $table->uuid('id_tipo_notificacion');
            $table->string('titulo', 100);
            $table->text('mensaje')->nullable();
            $table->boolean('leida')->default(false);
            $table->timestamp('fecha_envio')->nullable();

            $table->timestamps();
            $table->foreign('id_tipo_notificacion')->references('id_tipo_notificacion')->on('tipo_notificacion')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notificacion');
    }
};
