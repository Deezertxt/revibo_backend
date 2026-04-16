<?php

namespace App\Http\Controllers\Autoridad;

use App\Http\Controllers\Controller;
use App\Services\Autoridad\AutoridadService;
use App\Http\Requests\Autoridad\StoreAutoridadRequest;
use App\Http\Resources\AutoridadResource;
use App\Actions\Autoridad\GetAutoridadesAction;

class AutoridadController extends Controller
{
    public function __construct(protected AutoridadService $service){}
    public function index(GetAutoridadesAction $action){
        $autoridades = $action->execute();
        if ($autoridades){
            $data = [
                "message" => "Autoridades obtenidas exitosamente",
                "data" => new AutoridadResource($autoridades),
            ];
            return response()->json($data, 200);
        }else{
            $data = [
                "message"=> "Error al obtener autoridades",
            ];
            return response()->json($data, 404);
        }
    }

    public function store(StoreAutoridadRequest $request){
        $autoridad = $this->service->crear($request->validated());
        if ($autoridad) {
            $data = [
                "message"=> "Autoridad creada exitosamente",
                "data"=> new AutoridadResource($autoridad),
            ];
            return response()->json($data,200);
        } else {
            $data = [
                "message"=> "Error al crear autoridad",
            ];
            return response()->json($data,404);
        }
        
    }
}
