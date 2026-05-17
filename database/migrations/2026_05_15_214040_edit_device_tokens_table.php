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
        Schema::table('device_tokens', function (Blueprint $table) {
            $table->boolean('notification_enabled')->default(true)->nullable();
            $table->dateTime('last_seen_at')->nullable();
        });

        Schema::table('notificacion', function (Blueprint $table){
            $table->dropColumn('updated_at');
            $table->dateTime('read_at')->nullable();
        });

        Schema::create('user_locations', function(Blueprint $table){
            $table->uuid('id_user_location')->primary()->default(DB::raw('gen_random_uuid()'));
            $table->uuid('id_usuario');
            $table->geometry('geom', 'point', 4326)->nullable();
            $table->dateTime('recorded_at')->nullable();

            $table->foreign('id_usuario')->references('id_usuario')->on('usuario');
        });
        DB::statement('CREATE INDEX idx_user_loc_geom ON user_locations USING GIST (geom);');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('device_tokens', function (Blueprint $table) {
            //
            $table->dropColumn('notification_enabled');
            $table->dropColumn('last_seen_at');
        });
        Schema::table('notificacion', function (Blueprint $table){
            $table->dateTime('read_at');
            $table->timestamp('updated_at')->nullable();
        });
        Schema::dropIfExists('user_locations');
    }
};
