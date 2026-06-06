<?php

namespace App\Actions\Reporte;
use App\Models\Reporte;
class GetAllReportesByUserAction{
    public function execute($id_usuario){
        return Reporte::query()
                ->with(['fotos', 'usuario.institucion'])
                ->addSelect('reporte.*')
                ->addSelect(\DB::raw('ST_AsGeoJson(reporte.geom) AS geom_Json'))
                ->where('id_usuario', $id_usuario)
                ->orderBy('fecha_inicio', 'desc')
                ->get();
    }
}