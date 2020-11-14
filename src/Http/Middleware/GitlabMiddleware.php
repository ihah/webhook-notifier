<?php

namespace Ihah\WebhookNotifier\Http\Middleware;

use Closure;

class GitlabMiddleware
{
    public function handle($request, Closure $next)
    {
        if (config('webhook-notifier.gitlab_token') != $request->header('X_GITLAB_TOKEN')) {
            return response('Not authorized', 401);
        }

        return $next($request);
    }
}
