<?php

namespace App\Http\Requests\Reporte;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\TipoReporteEnum;
use App\Enums\GravedadReporteEnum;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rule;

class UpdateReporteRequest extends FormRequest
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
        return [
            "titulo" => "sometimes|string|max:100",
            "descripcion" => "sometimes|string|max:500",
            "tipo_reporte"=> ["sometimes", new Enum(TipoReporteEnum::class)],
            "fecha_inicio" => [Rule::requiredIf(fn() => $this->input('tipo_reporte') === 'cierre_programado'), 'date_format:d-m-Y H:i'],
            "fecha_fin" => [Rule::requiredIf(fn() => $this->input('tipo_reporte') === 'cierre_programado'), 'date_format:d-m-Y H:i'],
            "gravedad_reporte" => ["sometimes", new Enum(GravedadReporteEnum::class)],
            "geom" => "sometimes|array",
            "geom.type" => "sometimes|in:Point,LineString",
            "geom.coordinates" => "sometimes|array",
            "url_imagen" => "nullable|array|min:1",
            "url_imagen.*" => "url",
        ];
    }
}
