<?php

namespace Ihah\WebhookNotifier\Jobs;

use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendSlackNotifications implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $payload;

    protected $type;

    public function __construct(array $payload, string $type) 
    {
        $this->payload = $payload;
        $this->type = $type;
    }

    /**
     * Execute the job.
     *
     * @param  AudioProcessor  $processor
     * @return void
     */
    public function handle()
    {
        // Send message to specific channels based on payload type
        foreach (config('webhook-notifier.slack.channels.' . $this->type) as $channel) {
            $this->payload['channel'] = $channel['name'];
            sleep(1);
            $this->postMessage($channel['url']);
        }

        // Send any payload to all channels
        foreach (config('webhook-notifier.slack.channels.all') as $channel) {
            $this->payload['channel'] = $channel['name'];
            sleep(1);
            $this->postMessage($channel['url']);
        }
    }

    protected function postMessage(string $url)
    {
        $client = new Client([
            'headers' => ['Content-Type' => 'application/json']
        ]);

        $encoded = json_encode($this->payload, JSON_UNESCAPED_UNICODE);

        $response = $client->post($url, ['body' => $encoded]);

        $data = json_decode($response->getBody()->getContents());

        return $data;
    }

}
