<?php

namespace App\Http\Requests\Reporte;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\GravedadReporte;

class ReporteRequest extends FormRequest
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
            "descripcion" => "requided|string|max:500",
            "id_tipo_reporte"=> "required|string|exists:tipo_reporte,id_tipo_reporte",
            "id_gravedad_reporte" => "required|string|exist:gravedad_reporte,id_gravedad_reporte",
        ];
        $gravedades = GravedadReporte::getGravedades();

        if (in_array($this->id_tipo_reporte, $gravedades)) {
            $rules[""] = "";
        }

        return $rules;
    }
}
