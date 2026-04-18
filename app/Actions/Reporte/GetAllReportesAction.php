<?php

namespace App\Actions\Reporte;

use App\Models\Reporte;

class GetAllReportesAction
{
    public function execute()
    {
        return Reporte::with('fotos')
               ->orderBy('fecha_inicio', 'desc')
               ->get();
    }
}
