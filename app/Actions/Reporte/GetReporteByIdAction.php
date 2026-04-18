<?php

namespace App\Actions\Reporte;

use App\Models\Reporte;

class GetReporteByIdAction {
    public function execute(string $id) {
        return Reporte::query()
                ->with(['fotos', 'usuario.institucion'])
                ->addSelect('reporte.*')
                ->addSelect(\DB::raw('ST_AsGeoJson(reporte.geom) AS geom_Json'))
                ->where('id_reporte', $id)
                ->orderBy('fecha_inicio', 'desc')
                ->first();
    } 
}