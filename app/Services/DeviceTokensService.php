<?php 

namespace App\Services;

use App\Models\DeviceTokens;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class DeviceTokensService{
    public function crear(array $data){
        $lng = $data['lng'];
        $lat = $data['lat'];
        $dt = DB::transaction(function () use($data, $lng, $lat){
            $dvtn = DeviceTokens::updateOrCreate([
                'token' => $data['token']
            ],[
                'id_device_token' => Str::uuid(),
                'platform' => strtolower($data['platform']),
                'last_seen_at' => now(),
                'geom' => DB::raw("ST_SetSRID(ST_MakePoint($lng, $lat), 4326)"),
            ]);
            return $dvtn;
        });
        return $dt;
    }

    public function actualizar(array $data) {
        $lng = $data['lng'];
        $lat = $data['lat'];
        $id_usuario = request()->user()->id_usuario ?? null; 
        $dt = DB::transaction(function () use($data, $lng, $lat, $id_usuario){
            $dvtn = DeviceTokens::updateOrCreate([
                'token' => $data['token']
            ],[
                'id_usuario' => $id_usuario,
                'last_seen_at' => now(),
                'geom' => DB::raw("ST_SetSRID(ST_MakePoint($lng, $lat), 4326)"),
            ]);
            return $dvtn;
        });
        return $dt;
    }
}