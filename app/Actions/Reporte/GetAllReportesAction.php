<?php

namespace App\Actions\Reporte;

use App\Models\Reporte;

class GetAllReportesAction
{
    public function execute()
    {
        return Reporte::query()
                ->with(['fotos', 'usuario.institucion'])
                ->addSelect('reporte.*')
                ->addSelect(\DB::raw('ST_AsGeoJson(reporte.geom) AS geom_Json'))
                ->orderBy('fecha_inicio', 'desc')
                ->get();
    }
}
