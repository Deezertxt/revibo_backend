<?php

namespace App\Http\Resources\Reporte;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ImagenResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id_url_imagen"=> $this->id_url_imagen,
            "url_imagen"=> $this->url_imagen,
        ];
    }
}
