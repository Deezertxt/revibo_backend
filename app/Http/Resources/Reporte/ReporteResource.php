<?php

namespace App\Http\Resources\Reporte;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReporteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_reporte' => $this->id_reporte,
            'titulo' => $this->titulo,
            /* 'descripcion'=> $this->when(
                $request->routeIs('reporte.show'),
                $this->descripcion
            ), */
            'descripcion' => $this->descripcion,
            'institucion' => $this->usuario->institucion->nombre ?? 'Administracion',
            'tipo_reporte' => $this->tipo_reporte,
            'gravedad_reporte' => $this->gravedad_reporte,
            'geom' => $this->when(
                $this->geometry,
                fn () => json_decode($this->geometry)
            ),
            'estado' => $this->activo,
            'fecha_inicio'=> $this->fecha_inicio->format('d-m-Y H:i'),
            'fecha_fin'=> $this->whenNotNull(
                $this->fecha_fin?->format('d-m-Y H:i'),
            ),
            'imagenes' => $this->whenLoaded('fotos', function () {
                return $this->fotos->pluck('url_imagen');
            })
        ];
    }
}
