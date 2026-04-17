<?php

namespace App\Services\Reporte;

use App\Models\Reporte;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ReporteService{
    public function crear(array $data) {
        
        
        $fecha_inicio = $data['fecha_inicio'] ?? now();
        $fecha_fin = $data['fecha_fin'] ?? null;

        return DB::transaction(function() use($data, $fecha_inicio, $fecha_fin){
            $geoJson = json_encode($data["geom"]);
            $reporte = Reporte::create(array_merge($data, [
                "id_reporte" => Str::uuid(),
                "id_usuario" => request()->user()->id_usuario,
                "fecha_inicio" => $fecha_inicio, //tambien fecha de creacion
                "fecha_fin"=> $fecha_fin,
                "activo" => true
            ]));
            DB::update("UPDATE reporte SET geom = ST_SetSRID(ST_GeomFromGeoJSON(?), 4326) WHERE id_reporte = ?", [$geoJson, $reporte->id_reporte]);
            //dd($reporte->all());
            return $reporte->fresh();
       });           
    }

    public function actualizar(){

    }
}