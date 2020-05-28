<?php

namespace Ihah\WebhookNotifier\Helpers;

use Ihah\WebhookNotifier\Exceptions\KeyNotExistsInGitlabPayload;

class PayloadChecker
{
    public static function check(array $keys, array $payload)
    {
        foreach ($keys as $key) {
            if (!array_key_exists($key, $payload)) {
                throw new KeyNotExistsInGitlabPayload($key);
            }
        }
    }
}
