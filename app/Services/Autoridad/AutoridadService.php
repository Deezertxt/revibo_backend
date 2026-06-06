<?php

namespace App\Services\Autoridad;

use App\Enums\RolUsuario;
use Illuminate\Support\Str;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class AutoridadService{
    public function crear(array $data){
        return Usuario::create(array_merge($data,[
            "id_usuario"=> Str::uuid(),
            "password"=> Hash::make($data["contrasena"]),
            'estado' => true,
            'rol'=> RolUsuario::AUTORIDAD,
            "created_at"=> now(),
            "updated_at"=> now(),
        ]));  
    }

    public function eliminar($id){
        return Usuario::where("id_usuario", $id)->delete();
    }
}