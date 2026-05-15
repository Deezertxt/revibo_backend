<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRutaRequest extends FormRequest
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
            "nombre"=> "required|string|max:255",
            "distancia"=>"required|integer|min:1",
            "tiempo"=>"required|integer|min:1",
            "origen_nombre"=>"required|string|max:255",
            "destino_nombre"=>"required|string|max:255",
            "origen_lat"=>"sometimes|nullable|numeric|between:-90,90",
            "origen_lng"=>"sometimes|nullable|numeric|between:-180,180",
            "destino_lat"=>"sometimes|nullable|numeric|between:-90,90",
            "destino_lng"=>"sometimes|nullable|numeric|between:-180,180",
            "ruta" => "required|array",
            "ruta.type" => "required|in:LineString",
            "ruta.coordinates" => "required|array",
        ];
    }
}
