<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('device_tokens', function (Blueprint $table) {
            $table->geometry('geom', 'point', 4326)->nullable();
        });
        DB::statement('CREATE INDEX device_tokens_geom_index
        ON device_tokens
        USING GIST (geom)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP INDEX IF EXISTS device_tokens_geom_index');
        Schema::table('device_tokens', function (Blueprint $table) {
            $table->dropColumn('geom');
        });
    }
};
