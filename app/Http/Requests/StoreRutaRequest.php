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
            "distancia_km"=>"required|integer|min:1",
            "tiempo"=>"required|integer|min:1",
            "nombre_origen"=>"required|string|max:255",
            "nombre_destino"=>"required|string|max:255",
            "ori_lat"=>"sometimes|nullable|numeric|between:-90,90",
            "ori_lng"=>"sometimes|nullable|numeric|between:-180,180",
            "dest_lat"=>"sometimes|nullable|numeric|between:-90,90",
            "dest_lng"=>"sometimes|nullable|numeric|between:-180,180",
            "geom" => "required|array",
            "geom.type" => "required|in:LineString",
            "geom.coordinates" => "required|array",
        ];
    }
}
