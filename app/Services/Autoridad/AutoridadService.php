<?php

namespace App\Services\Autoridad;

use App\Enums\RolUsuario;
use Illuminate\Support\Str;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class AutoridadService{
    public function crear(array $data){
        return Usuario::create(array_merge($data,[
            "id_autoridad"=> Str::uuid(),
            "password"=> Hash::make($data["contrasena"]),
            'estado' => true,
            'rol'=> RolUsuario::AUTORIDAD,
            "created_at"=> now(),
            "updated_at"=> now(),
        ]));  
    }

    public function actualizar(){

    }

    public function eliminar(){

    }
}