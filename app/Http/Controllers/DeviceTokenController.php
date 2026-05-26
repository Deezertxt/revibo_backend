<?php

namespace App\Http\Controllers;

use App\Models\DeviceTokens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreDTknRequest;
use App\Services\DeviceTokensService;

class DeviceTokenController extends Controller
{
    public function __construct(protected DeviceTokensService $service){}
    /* protected function getIdUsuario(){
        return request()->user()->id_usuario;
    } */
    public function store(StoreDTknRequest $request){
        $dt = $this->service->crear($request->validated());
        if($dt){
            return response()->json(["message" => "first token and position saved"], 201);
        }
    }

    public function sync(StoreDTknRequest $request){
        $dt = $this->service->actualizar($request->validated());
        if($dt){
            return response()->json(["message" => "Position updated"], 201);
        }
    }
}
