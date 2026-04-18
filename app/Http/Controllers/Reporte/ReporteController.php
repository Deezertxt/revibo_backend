<?php

namespace App\Http\Controllers\Reporte;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reporte\StoreReporteRequest;
use App\Services\Reporte\ReporteService;
use App\Http\Resources\Reporte\ReporteResource;
use App\Actions\Reporte\GetAllReportesAction;
use App\Actions\Reporte\GetReporteByIdAction;

class ReporteController extends Controller
{
    public function __construct(protected ReporteService $service){}
    public function index(GetAllReportesAction $action){
        $reporte = $action->execute();
        if($reporte){
            $data = [
                "message"=> "Reportes obtenidos correctamente",
                "data" => ReporteResource::collection($reporte),
            ];
            return response()->json($data, 200);
        }else{
            $data = [
                "message" => "Error al obtener reportes",
            ];
            return response()->json($data, 404);
        }
    }

    public function show(string $id_reporte, GetReporteByIdAction $action){
        $reporte = $action->execute($id_reporte);

        if($reporte){
            $data = [
                "message"=> "Reporte obtenido correctamente",
                "data" => new ReporteResource($reporte),
            ];
            return response()->json($data, 200);
        }else{
            $data = [
                "message" => "Reporte no encontrado",
            ];
            return response()->json($data, 404);
        }
    }

    public function store(StoreReporteRequest $request){
        $reporte = $this->service->crear($request->validated());
        $reporte = app(GetReporteByIdAction::class)->execute($reporte->id_reporte);
        if($reporte){
            $data = [
                "message"=> "Reporte creado correctamente",
                "data" => new ReporteResource($reporte),
            ];
            return response()->json($data, 200);
        }else{
            $data = [
                "message" => "Error al crear reportes",
            ];
            return response()->json($data, 404);
        }
    }
}
