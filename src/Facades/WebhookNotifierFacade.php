<?php

namespace Ihah\WebhookNotifier\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Ihah\WebhookNotifiers\Skeleton\SkeletonClass
 */
class WebhookNotifierFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'WebhookNotifier';
    }

    /**
     * Register the typical authentication routes for an application.
     *
     * @param  array  $options
     * @return void
     */
    public static function routes(array $options = [])
    {
        static::$app->make('router')->webhooks($options);
    }
}
