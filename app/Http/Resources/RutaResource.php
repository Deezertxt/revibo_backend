<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RutaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id_ruta"=>$this->id_ruta,
            "nombre"=>$this->nombre,
            "distancia_km"=>$this->distancia,
            "tiempo_seg"=>$this->tiempo,
            "nombre_origen"=>$this->origen_nombre,
            "nombre_destino"=>$this->destino_nombre,
            'geom_ruta' => $this->geom_json ? json_decode($this->geom_json) : null,
        ];
    }
}
