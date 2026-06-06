<?php

namespace App\Listeners;

use App\Events\ReporteCreadoEvent;
use App\Jobs\ResolveAffectedRoutesJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyAffectedRoutesListener
{
    /**
     * Create the event listener.
     */
    public function __construct(

    )
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ReporteCreadoEvent $event): void
    {
        ResolveAffectedRoutesJob::dispatch(
            $event->reporte
        );
    }
}
