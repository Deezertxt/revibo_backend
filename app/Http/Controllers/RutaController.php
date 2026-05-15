<?php

namespace App\Http\Controllers;

use App\Http\Resources\RutaResource;
use App\Http\Requests\StoreRutaRequest;
use App\Services\RutaService;
use App\Actions\Ruta\GetAllRutasByUserAction;
use App\Actions\Ruta\GetRutaByIdAction;

class RutaController extends Controller
{
    public function __construct(protected RutaService $service){}

    protected function getIdUsuario(){
        return request()->user()->id_usuario;
    }

    public function index (GetAllRutasByUserAction $action){
        $rutas = $action->execute($this->getIdUsuario());
        if($rutas){
            $data = [
                "message" => "Rutas obtenidas exitosamente",
                "data" => RutaResource::collection($rutas)
            ];
            return response()->json($data, 200);
        }else{
            return response()->json(["message" => "Error al obtener rutas de usuario"], 404);
        }
    }
    public function store(StoreRutaRequest $request){
        //dd($this->getIdUsuario());
        $ruta = $this->service->crear($request->validated(), $this->getIdUsuario());
        //dd($ruta);
        $ruta = app(GetRutaByIdAction::class)->execute($ruta->id_ruta);
        if($ruta){
            $data = [
                "message" => "Ruta creada exitosamente",
                "data" => new RutaResource($ruta)
            ];
            return response()->json($data, 200);
        }else{
            return response()->json(["message" => "Error al crear ruta"], 400);
        }
    }
}
