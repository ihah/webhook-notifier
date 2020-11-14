<?php

use Illuminate\Support\Facades\Route;
use Ihah\WebhookNotifier\Http\Controllers\SlackWebhookController;

return [
    Route::post('/slack', [SlackWebhookController::class, 'notify'])->name('slack'),
];

