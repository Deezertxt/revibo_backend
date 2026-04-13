<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Str;
use App\Enums\RolUsuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request) //registro usuarios normales
    {
        $data = [];
        // Validar los datos de registro
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|string|email|max:255|unique:usuario,correo',
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
            //'rol' => RolUsuario::USUARIO, // Asignar rol de usuario normal
            'estado' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $usuario->rol = RolUsuario::USUARIO;
        $usuario->save();
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

    public function login(Request $request){
        $validated = $request->validate([
            'correo'=> 'required|email',
            'contrasena' => 'required'
        ]);

        $user = Usuario::where('correo', $validated['correo'])->first();
    
        if (!$user || !Hash::check($validated['contrasena'], $user->password)) {
            Throw ValidationException::withMessages([
                'email'=> ['Credenciales incorrectas'],
            ]);
        }

        $token = $user->createToken('mobile-token')->plainTextToken;

        return response()->json([
            'message' => 'Sesion iniciada correctamente',
            'user' => $user,
            'access_token' => $token
        ]);
    } 

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Sesion cerrada correctamente',
        ]);
    }
}
