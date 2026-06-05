<?php

namespace App\Jobs;

use App\Models\DeviceTokens;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use App\Jobs\SendPushNotificationJob;
use App\Jobs\SendPushChunkResolvedJob;

class ResolveDeletedReportDevicesJob implements ShouldQueue
{
    use Queueable, Dispatchable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public string $geomWkt,
        public string $gravedad,
        public string $titulo
    )
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
        logger()->info('devices encontrados',[
            'count' => $devices->count(),
            'tokens' => $devices->pluck('token')
        ]);
        logger()->info('geom wkt',[
            'wkt' => $this->geomWkt,
            'radius' => $radius
        ]);
        $devices
            ->chunk(100)
            ->each(function ($chunk){
                SendPushChunkResolvedJob::dispatch(
                    $chunk->pluck('token')->toArray(),
                    $this->titulo
                );
            });
    }

    private function resolveRadius(): int {
        return match($this->gravedad){
            'Bajo' => 1000,
            'Medio' => 3000,
            'Alto' => 5000,
            'Critico' => 10000,
            default => 3000
        };
    }

    private function findNearbyDevices(int $radius)
{
    return DeviceTokens::query()
        ->whereRaw("
            ST_DWithin(
                geom::geography,
                ST_GeomFromText(?,4326)::geography,
                ?
            )
        ", [
            $this->geomWkt,
            $radius
        ])
        ->whereNotNull('token')
        ->get();
}
}
