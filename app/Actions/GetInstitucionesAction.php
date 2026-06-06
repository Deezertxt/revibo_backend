<?php

namespace App\Actions;

use App\Models\Institucion;

class GetInstitucionesAction {
    public function execute(){
        return Institucion::all();
    }

}