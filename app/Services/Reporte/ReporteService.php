<?php

namespace App\Services\Reporte;

use App\Events\ReporteCreadoEvent;
use App\Models\Reporte;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ReporteService{
    

    public function crear(array $data) {
        $fecha_inicio = $data['fecha_inicio'] ?? now();
        $fecha_fin = $data['fecha_fin'] ?? null;

      
        $geoJson = json_encode($data["geom"]);
        unset($data["geom"]);
        
       
        $urlImagenes = $data['url_imagen'] ?? [];
        unset($data['url_imagen']);

       
        $idReporteNuevo = (string) Str::uuid();

     
        $reporte = Reporte::create(array_merge($data, [
            "id_reporte" => $idReporteNuevo,
            "id_usuario" => request()->user()->id_usuario,
            "fecha_inicio" => $fecha_inicio, 
            "fecha_fin"=> $fecha_fin,
            "activo" => true
        ]));

     
        if(!empty($urlImagenes)){
            $imagenes = array_map(fn($url) => [
                'id_url_imagen_reporte' => (string) Str::uuid(),
                'id_reporte'            => $idReporteNuevo,
                'url_imagen'            => $url,
                'created_at'            => now(),
                'updated_at'            => now()
            ], $urlImagenes);
            
            DB::table('url_imagen_reporte')->insert($imagenes);
        }

        
        DB::update("UPDATE reporte SET geom = ST_SetSRID(ST_GeomFromGeoJSON(?), 4326) WHERE id_reporte = ?", [$geoJson, $idReporteNuevo]);
        
        return $reporte->fresh();
    }

    public function actualizar(){
        // ...
    }
}