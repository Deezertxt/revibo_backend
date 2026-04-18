<?php

namespace App\Http\Requests\Reporte;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\TipoReporteEnum;
use App\Enums\GravedadReporteEnum;
use Illuminate\Validation\Rules\Enum;


class StoreReporteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    
    public function rules(): array
    {
        $rules = [
            "titulo" => "required|string|max:100",
            "descripcion" => "required|string|max:500",
            "tipo_reporte"=> ["required", new Enum(TipoReporteEnum::class)],
            "gravedad_reporte" => ["required", new Enum(GravedadReporteEnum::class)],
            "geom" => "required|array",
            "geom.type" => "required|in:Point,LineString",
            "geom.coordinates" => "required|array",
            "url_imagen" => "nullable|array|min:1",
            "url_imagen.*" => "url"
        ];

        if ($this->tipo_reporte == TipoReporteEnum::CIERRE_PROGRAMADO->value) {
            $rules["fecha_inicio"] = "required|date|after_or_equal:today";
            $rules["fecha_fin"] = "required|date|after_or_equal:fecha_inicio";
        }

        return $rules;
    }

    /* public function withValidator($validator){
        $validator->after(function ($validator) {

            $type = $this->input('geom.type');
            $coordinates = $this->input('geom.coordinates');

            if ($type === 'Point') {
                if (count($coordinates) !== 2) {
                    $validator->errors()->add('geom.coordinates', 'Point debe tener exactamente 2 coordenadas.');
                    return;
                }

                if (!$this->isValidCoordinate($coordinates)) {
                    $validator->errors()->add('geom.coordinates', 'Coordenadas inválidas.');
                }
            }

            if ($type === 'LineString') {
                if (count($coordinates) < 2) {
                    $validator->errors()->add('geom.coordinates', 'LineString debe tener al menos 2 puntos.');
                    return;
                }

                foreach ($coordinates as $point) {
                    if (!$this->isValidCoordinate($point)) {
                        $validator->errors()->add('geom.coordinates', 'Uno de los puntos es inválido.');
                        break;
                    }
                }
            }

        });
    }

    private function isValidCoordinate($point): bool {
        if (!is_array($point) || count($point) !== 2) {
            return false;
        }

        [$lng, $lat] = $point;

        return is_numeric($lng) &&
           is_numeric($lat) &&
           $lng >= -180 && $lng <= 180 &&
           $lat >= -90 && $lat <= 90;
    } */
}
