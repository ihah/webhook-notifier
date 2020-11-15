<?php

namespace Ihah\WebhookNotifier;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Ihah\WebhookNotifier\Services\WebhookNotifier;
use Ihah\WebhookNotifier\Http\Middleware\GitlabMiddleware;

class WebhookNotifierServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->registerRoutes();

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
        // Register the main class to use with the facade
        $this->app->singleton('WebhookNotifier', function () {
            return new WebhookNotifier;
        });
    }

    protected function registerRoutes()
    {
        Route::group($this->slackRouteConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/slack.php');
        });
    }

    protected function slackRouteConfiguration()
    {
        return [
            'prefix' => config('webhook-notifier.slack.prefix', ''),
            'middleware' => array_merge(config('webhook-notifier.slack.middleware', []), [GitlabMiddleware::class]),
        ];
    }
}
