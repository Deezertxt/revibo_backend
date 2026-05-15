<?php

namespace App\Actions\Ruta;

use App\Models\Ruta;
class GetAllRutasByUserAction{
    public function execute(string $id){
        return Ruta::query()
                ->addSelect('ruta.*')
                ->addSelect(\DB::raw('ST_AsGeoJson(ruta.ruta) AS geom_Json'))
                ->where('id_usuario', $id)
                ->orderBy('created_at', 'desc')
                ->get();
    }
}

