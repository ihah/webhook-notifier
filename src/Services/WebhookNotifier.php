<?php

namespace Ihah\WebhookNotifier\Services;

use Illuminate\Support\Facades\Facade;

class WebhookNotifier extends Facade
{
    /**
     * @return string
     */
    public static function getFacadeAccessor() {
        return 'WebhookNotifier';
    }
}
