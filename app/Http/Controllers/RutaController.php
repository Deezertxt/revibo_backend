<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreRutaRequest;
use App\Services\RutaService;

class RutaController extends Controller
{
    public function __construct(protected RutaService $service){}

    public function index (){

    }
    public function store(StoreRutaRequest $request){
        $ruta = $this->service->crear($request->validated());
        if($ruta){
            $data = [
                "message" => "Ruta creada exitosamente",
                "data" => $ruta
            ];
            return response()->json($data, 200);
        }else{
            return response()->json(["message" => "Error al crear ruta"], 400);
        }
    }
}
