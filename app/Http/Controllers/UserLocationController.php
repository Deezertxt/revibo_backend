<?php

namespace App\Http\Controllers;

use App\Models\UserLocations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserLocationController extends Controller
{
    protected function getIdUsuario(){
        return request()->user()->id_usuario;
    }
    public function store(Request $request){
        $validated = $request->validate([
            "lat" => "required|numeric|between:-90,90",
            "lng" => "required|numeric|between:-180,180"
        ]);
        $lng = $validated['lng'];
        $lat = $validated['lat'];
        $location = UserLocations::updateOrCreate(
            [
                'id_user_location' => Str::uuid(),
                'id_usuario' => $this->getIdUsuario()
            ],
            [
                'geom' => DB::raw("ST_SetSRID(ST_MakePoint($lng, $lat), 4326)")
            ]
        );
        if($location){
            return response()->json(["message" => "Location saved"], 201);
        }else{
            return response()->json(["message" => "Error saving location"], 500);
        }
    }
}
