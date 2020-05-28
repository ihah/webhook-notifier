<?php

namespace Ihah\WebhookNotifier\Notifiers;

use GuzzleHttp\Client;

class SlackNotifier
{

    public function notify(array $payload, String $type)
    {
        // Send message to specific channels based on payload type
        foreach (config('webhook-notifier.slack.channels.' . $type) as $channel) {
            $payload['channel'] = $channel['name'];
            sleep(1);
            $this->postMessage($payload, $channel['url']);
        }

        // Send any payload to all channels
        foreach (config('webhook-notifier.slack.channels.all') as $channel) {
            $payload['channel'] = $channel['name'];
            sleep(1);
            $this->postMessage($payload, $channel['url']);
        }
    }

    public function postMessage(array $payload, string $url)
    {
        $client = new Client([
            'headers' => ['Content-Type' => 'application/json']
        ]);

        $encoded = json_encode($payload, JSON_UNESCAPED_UNICODE);

        $response = $client->post($url, ['body' => $encoded]);

        $data = json_decode($response->getBody()->getContents());

        return $data;
    }
}
