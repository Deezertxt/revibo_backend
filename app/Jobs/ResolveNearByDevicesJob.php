<?php

namespace App\Jobs;

use App\Models\DeviceTokens;
use App\Models\Reporte;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ResolveNearByDevicesJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Reporte $reporte)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $radius = $this->resolveRadius();
        $devices = $this->findNearbyDevices($radius);

        $devices
            ->chunk(100)
            ->each(function ($chunk){
                SendPushchunkJob::dispatch(
                    $chunk,
                    $this->reporte
                );
            });
    }

    private function resolveRadius(): int{
        return match ($this->reporte->gravedad_reporte) {
            'Bajo' => 1000,
            'Medio' => 3000,
            'Alto' => 5000,
            'Critico' => 10000,
            default => 3000
        };
    }

    private function findNearbyDevices(int $radius){
        return DeviceTokens::query()
            ->whereRaw("
                ST_DWithin(
                    geom::geography,
                    (
                        SELECT geom::geography
                        FROM reporte
                        WHERE id_reporte = ?
                    ),
                    ?

                )
            ",[
                $this->reporte->id_reporte,
                $radius
            ])
            ->whereNotNull('token')
            ->get();
    }
}
