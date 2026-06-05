<?php

namespace App\Listeners;

use App\Events\ReporteResueltoEvent;
use App\Jobs\ResolveDeletedReportDevicesJob;
use App\Jobs\ResolveNearByDevicesJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendReportResolvedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ReporteResueltoEvent $event): void
    {
        ResolveDeletedReportDevicesJob::dispatch(
            $event->geomWkt,
            $event->gravedadReporte,
            $event->tituloReporte
        );
    }
}
