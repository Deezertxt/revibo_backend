<?php

namespace App\Services;

use App\Models\Ruta;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
class RutaService{
    public function crear(array $data, string $id_usuario) {
        return DB::transaction(function() use($data, $id_usuario){
            $geojson = json_encode($data['ruta']);
            $ruta = Ruta::create(array_merge($data, [
                "id_ruta" => Str::uuid(),
                "id_usuario" => $id_usuario,
                "created_at" => now(),
                "updated_at" => now(),
                "activa" => true,
            ]));
            DB::update("UPDATE ruta SET ruta = ST_SetSRID(ST_GeomFromGeoJSON(?), 4326) WHERE id_ruta = ?", [$geojson, $ruta->id_ruta]);
            return $ruta->fresh();
        });
    }

    public function actualizar(){
        
    }
}