<?php

namespace App\Providers;

use App\Events\ReporteResueltoEvent;
use App\Listeners\NotifyAffectedRoutesListener;
use App\Listeners\PruebaNotiReporteGralListener;
use App\Listeners\SendNearByReportNotificationListener;
use App\Listeners\SendReportResolvedListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
//use Illuminate\Support\ServiceProvider;
use App\Events\ReporteCreadoEvent;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    protected $listen = [
        ReporteCreadoEvent::class => [
            SendNearByReportNotificationListener::class,
            NotifyAffectedRoutesListener::class
        ],
        ReporteResueltoEvent::class => [
            SendReportResolvedListener::class,
        ]
    ];

    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
