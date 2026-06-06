<?php

namespace App\Jobs;

use App\Models\Reporte;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class SendPushchunkJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Collection $devices,
        public Reporte $reporte
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $messages = [];

        foreach($this->devices as $device) {
            $messages[] = [
                'to' => $device->token,
                'title' => 'Nuevo incidente cercano',
                'body' => $this->reporte->titulo,
                'data' => [
                    'id_reporte' => $this->reporte->id_reporte
                ]
            ];
        }

        Http::post('https://exp.host/--/api/v2/push/send', $messages);
    }
}
