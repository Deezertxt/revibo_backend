<?php

namespace App\Jobs;

use App\Models\Reporte;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;

class DeleteExpiredReportsJob implements ShouldQueue
{
    use Queueable, Dispatchable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $deleted = Reporte::query()
                ->whereNotNull('fecha_fin')
                ->where('fecha_fin', '<=', now())
                ->delete();

        logger()->info('reportes expireados eliminados',[
            'cantidad' => $deleted
        ]);
    }
}
