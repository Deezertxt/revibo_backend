<?php

namespace App\Actions\Autoridad;

use App\Models\Usuario;

class GetAutoridadesAction
{

    public function execute()
    {
        return Usuario::where('rol', 'autoridad')
                ->with('institucion:id_institucion,nombre,descripcion')
                ->orderBy('created_at', 'desc')
                ->get();
    }
}
