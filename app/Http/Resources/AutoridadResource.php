<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AutoridadResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id_autoridad" => $this->id_usuario ?? $this->id,
            "nombre" => $this->nombre,
            "correo" => $this->correo,
            "cargo" => $this->cargo,
            "institucion" => $this->institucion ? [
                "id_institucion" => $this->institucion->id_institucion,
                "nombre" => $this->institucion->nombre,
                "descripcion" => $this->institucion->descripcion,
            ] : null,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
