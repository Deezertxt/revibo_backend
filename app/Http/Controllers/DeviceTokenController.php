<?php

namespace App\Http\Controllers;

use App\Models\DeviceTokens;
use Illuminate\Http\Request;

class DeviceTokenController extends Controller
{
    protected function getIdUsuario(){
        return request()->user()->id_usuario;
    }
    public function store(Request $request){
        $request->validate([
            'token' => 'requires|string',
            'platform' => 'required|string'
        ]);

        DeviceTokens::updateOrCreate([
            'token' => $request->token
        ],[
            'id_usuario' => $this->getIdUsuario(),
            'platform' => strtolower($request->platform),
            'active' => true
        ]);
        return response()->json(["message" => "token saved"], 201);
    }
}
