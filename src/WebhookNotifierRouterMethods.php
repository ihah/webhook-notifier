<?php

namespace Ihah\WebhookNotifier;

class WebhookNotifierRouterMethods
{
    public function webhooks()
    {
        return function ($options = []) {
            $this->middleware($options['middlewares'])->prefix('gitlab/notify/')->name('gitlab.notify.')->group(function () {
                $this->post('/slack', '\Ihah\WebhookNotifier\Http\Controllers\SlackWebhookController@notify')->name('slack');
            });
        };
    }
}
