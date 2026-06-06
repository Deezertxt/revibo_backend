<?php

namespace App\Jobs;

use App\Models\Reporte;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ResolveAffectedRoutesJob implements ShouldQueue
{
    use Queueable, Dispatchable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Reporte $reporte
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $reporteGeom = DB::table('reporte')
            ->where(
                'id_reporte',
                $this->reporte->id_reporte
            )
            ->selectRaw('ST_AsText(geom) as geom')
            ->first();

        if (!$reporteGeom) {

            Log::error(
                'No se encontró geometría reporte'
            );

            return;
        }

        $wkt = $reporteGeom->geom;


        $tokens = DB::table('ruta as r')

            ->join(
                'device_tokens as dt',
                'dt.id_usuario',
                '=',
                'r.id_usuario'
            )

            ->whereRaw(
                "
            ST_Dwithin(
                r.ruta::geography,
                ST_GeomFromText(?, 4326)::geography,
                300
            )
            ",
                [$wkt]
            )

            ->whereNotNull('dt.token')
            ->distinct()
            ->pluck('dt.token');

        if ($tokens->isEmpty()) {

            Log::warning(
                'No se encontraron tokens'
            );

            return;
        }

        SendPushNotificationJob::dispatch(
            $tokens->toArray(),
            $this->reporte->titulo,
            $this->reporte->descripcion
        );
    }
}
