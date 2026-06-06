<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class SendPushChunkResolvedJob implements ShouldQueue
{
    use Queueable, Dispatchable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public array $tokens,
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
        logger()->info('ENTRE A SENDPUSHCHUNKRESOLVEDJOB');
        $messages = [];
        logger()->info('Mensajes a enviar', [
            'messages' => $messages
        ]);
        foreach($this->tokens as $token) {
            $messages[] = [
                'to' => $token,
                'sound' => 'default',
                'title' => 'Reporte cercano resuelto',
                'body' => $this->titulo,
            ];
        }

        //Http::post('https://exp.host/--/api/v2/push/send', $messages);
        /* $messages = [];

        foreach($this->tokens as $token){
            $messages[] = [
                'to' => $token,
                'sound' => 'default',
                'title' => 'Incidente cercano resuelto',
                'body' => $this->titulo,
            ];
        }
        */ 
        
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-type' => 'application/json'
        ])->post('https://exp.host/--/api/v2/push/send', $messages);

        logger()->info('expo response', [
            'status' => $response->status(),
            'body' => $response->body(),
            'json' => $response->json()
        ]);
    }
}
