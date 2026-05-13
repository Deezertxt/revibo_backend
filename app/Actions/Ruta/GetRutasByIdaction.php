<?php

namespace App\Actions\Ruta;

use App\Models\Ruta;
class GetRutasByIdAction{
    public function execute(string $id){
        return Ruta::query()
                ->addSelect('reporte.*')
                ->addSelect(\DB::raw('ST_AsGeoJson(reporte.geom) AS geom_Json'))
                ->where('id_reporte', $id)
                ->orderBy('fecha_inicio', 'desc')
                ->get();
    }
}