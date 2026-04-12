<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Str;
use App\Enums\RolUsuario;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function register(Request $request) //registro usuarios normales
    {
        $data = [];
        // Validar los datos de registro
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|string|email|max:255|unique:usuario',
            'contrasena' => 'required|string|min:8',
            'confirmacion_contrasena' => 'required|string|same:contrasena',
        ]);

        //dd($validatedData);
        // Crear el usuario
        $usuario = Usuario::create([
            'id_usuario' => Str::uuid(),
            'nombre' => $validatedData['nombre'],
            'correo' => $validatedData['correo'],
            'password' => Hash::make($validatedData['contrasena']),
            'rol' => RolUsuario::USUARIO, // Asignar rol de usuario normal
            'estado' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        // Generar token de autenticación
        $token = $usuario->createToken('mobile_token')->plainTextToken;

        if ($usuario){
            $data = [
                'message' => 'Usuario registrado exitosamente',
                'data' => $usuario,
                'access_token' => $token
            ];
        }else{
            $data = [
                'message' => 'Error al registar usuario'
            ];
        }
        return response()->json($data, 201);
    }

    public function iniciarSesion(){

    }
}
