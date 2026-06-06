<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actions\GetInstitucionesAction;

class InstitucionController extends Controller
{
    public function index(GetInstitucionesAction $action){
        $instituciones = $action->execute();
        if($instituciones){
            $data = [
                "message" => "Instituciones obtenidas correctamente",
                "data" => $instituciones
            ];
            return response()->json($data,200);
        } else{
            $data = [
                "message"=> "Error al obtener instituciones"
            ];
            return response()->json($data,404);
        }
    }
}   
