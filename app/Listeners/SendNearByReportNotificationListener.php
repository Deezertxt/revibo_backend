<?php

namespace App\Listeners;

use App\Events\ReporteCreadoEvent;
use App\Jobs\ResolveNearByDevicesJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendNearByReportNotificationListener
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
    public function handle(ReporteCreadoEvent $event): void
    {
        ResolveNearByDevicesJob::dispatch(
            $event->reporte
        );
    }
}
