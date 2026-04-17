<?php

namespace App\Http\Controllers\Reporte;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reporte\StoreReporteRequest;
use App\Services\Reporte\ReporteService;

class ReporteController extends Controller
{
    public function __construct(protected ReporteService $service){}
    public function index(){

    }

    public function store(StoreReporteRequest $request){
        $reporte = $this->service->crear($request->validated());
    }
}
