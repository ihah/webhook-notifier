<?php

namespace Ihah\WebhookNotifier\Exceptions;

use Exception;

class KeyNotExistsInGitlabPayload extends Exception
{
    protected $missingKey;

    public function __construct($key)
    {
        $this->missingKey = $key;
        $message = $key . ' does not exits in gitlab payload.';
        parent::__construct($message);
    }

    public function getMissingKey()
    {
        return $this->missingKey;
    }
}
