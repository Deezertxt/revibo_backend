<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;

class SendPushNotificationJob implements ShouldQueue
{
    use Queueable, Dispatchable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public array $tokens,
        public string $title,
        public string $body
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

        foreach($this->tokens as $token){
            $messages[] = [
                'to' => $token,
                'sound' => 'default',
                'title' => 'incidente en tus rutas',
                'body' => $this->title,
            ];
        }

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
