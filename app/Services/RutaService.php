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

    public function actualizar(array $data, string $id_ruta, string $id_usuario) {
        return DB::transaction(function() use($data, $id_ruta, $id_usuario){
            $ruta = Ruta::where('id_ruta', $id_ruta)
                ->where('id_usuario', $id_usuario)
                ->first();

            if(!$ruta){
                return null;
            }

            if(array_key_exists('ruta', $data)){
                $geojson = json_encode($data['ruta']);
                unset($data['ruta']);
                DB::update(
                    "UPDATE ruta SET ruta = ST_SetSRID(ST_GeomFromGeoJSON(?), 4326) WHERE id_ruta = ?",
                    [$geojson, $ruta->id_ruta]
                );
            }

            $data['updated_at'] = now();
            $ruta->update($data);

            return $ruta->fresh();
        });
    }

    public function eliminar(string $id_ruta, string $id_usuario): bool {
        $ruta = Ruta::where('id_ruta', $id_ruta)
            ->where('id_usuario', $id_usuario)
            ->first();

        if(!$ruta){
            return false;
        }

        return (bool)$ruta->delete();
    }
}