<?php

namespace Ihah\WebhookNotifier;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Ihah\WebhookNotifier\Services\WebhookNotifier;

class WebhookNotifierServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        Route::mixin(new WebhookNotifierRouterMethods);

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('webhook-notifier.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'webhook-notifier');

        // Register the main class to use with the facade
        $this->app->singleton('WebhookNotifier', function () {
            return new WebhookNotifier;
        });
    }
}
