<?php

namespace Ihah\WebhookNotifier\Helpers;

use Ihah\WebhookNotifier\Formaters\Slack\PushFormatter;

class SlackFormatter
{
    protected $requiredPayloadKeys = ['object_kind'];

    public function format(array $payload)
    {
        PayloadChecker::check($this->requiredPayloadKeys, $payload);

        switch ($payload['object_kind']) {
            case 'push':
                return (new PushFormatter())->format($payload);
                break;
            default:
                return [];
                break;
        }

        return [];
    }
}
