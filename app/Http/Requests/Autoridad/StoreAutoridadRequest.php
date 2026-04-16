<?php

namespace App\Http\Requests\Autoridad;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreAutoridadRequest extends FormRequest
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
            "nombre"=> "required|string|max:100",
            "correo"=> "required|email|unique:usuario,correo",
            "contrasena"=> "required|string|max:12",
            "confirmacion_contrasena"=> "required|string|max:12|same:contrasena",
            "id_institucion"=> "required|exists:institucion,id_institucion",
        ];
    }

    public function messages(): array{
        return [
            "nombre.required"=> "El nombre es obligatorio",
            "correo.required"=> "El correo es obligatorio",
            "correo.unique"=> "El correo ya ha sido registrado",
            "contrasena"=> "Contraseña requerida",
            "contrasena.same"=> "Las contraseñas deben coincidir",
            "id_institucion"=> "La institucion es requerida",
        ];
    }

    public function failedValidation(Validator $validator): array{
        throw new HttpResponseException(response()->json([
            'status' => 'error',
            'message' => 'Error en los datos enviados',
            'errors' => $validator->errors()
        ], 422));  
    }
}
