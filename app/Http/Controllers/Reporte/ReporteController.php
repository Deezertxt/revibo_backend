<?php

namespace App\Http\Controllers\Reporte;

use App\Actions\Reporte\GetAllReportesByUserAction;
use App\Events\ReporteResueltoEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Reporte\StoreReporteRequest;
use App\Http\Requests\Reporte\UpdateReporteRequest;
use App\Services\Reporte\ReporteService;
use App\Http\Resources\Reporte\ReporteResource;
use App\Actions\Reporte\GetAllReportesAction;
use App\Actions\Reporte\GetReporteByIdAction;
use App\Models\Reporte;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    public function __construct(protected ReporteService $service){}

    protected function getIdUsuario(){
        return request()->user()->id_usuario;
    }
    public function index(GetAllReportesAction $action){
        $reporte = $action->execute();
        if($reporte){
            $data = [
                "message"=> "Reportes obtenidos correctamente",
                "data" => ReporteResource::collection($reporte),
            ];
            return response()->json($data, 200);
        }else{
            return response()->json([
                "message" => "Error al obtener reportes",
            ], 404);
        }
    }

    public function indexByUser(GetAllReportesByUserAction $action){
        $reportes = $action->execute($this->getIdUsuario());

        if($reportes){
            $data = [
                'message' => 'Reportes de usuario obtenidos correctamente',
                'data' => ReporteResource::collection($reportes)
            ];
            return response()->json($data, 200);
        }else{
            return response()->json([
                "message" => "Error al obtener reportes del usuario",
            ], 404);
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
            return response()->json([
                "message" => "Reporte no encontrado",
            ], 404);
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
            return response()->json([
                "message" => "Error al crear reportes",
            ], 404);
        }
    }

    public function update(UpdateReporteRequest $request, string $id){
        $reporte = $this->service->actualizar($request->validated(), $id);
        $reporte = app(GetReporteByIdAction::class)->execute($reporte->id_reporte);
        if($reporte){
            $data = [
                "message"=> "Reporte editado correctamente",
                "data" => new ReporteResource($reporte),
            ];
            return response()->json($data, 200);
        }else{
            return response()->json([
                "message" => "Error al editar reportes",
            ], 404);
        }
    }

    public function destroy(string $id_reporte){
        $reporte = Reporte::findOrFail($id_reporte);
        $wkt = DB::table('reporte')
                ->where('id_reporte', $id_reporte)
                ->selectRaw('ST_AsText(geom) as geom')
                ->first()
                ->geom;
        event(new ReporteResueltoEvent(
            geomWkt: $wkt,
            gravedadReporte: $reporte->gravedad_reporte,
            tituloReporte: $reporte->titulo
        ));
        
        if(!$reporte){
            return response()->json(["mesagge" => "reporte no encontrado"], 404);
        }
        DB::table('url_imagen_reporte')->where('id_reporte', $id_reporte)->delete();
        $reporte->delete();
        return response()->json(["message" => "reporte eliminado"], 200);
    }
}
