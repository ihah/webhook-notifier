<?php

namespace Ihah\WebhookNotifier\Http\Controllers;

use Exception;
use Illuminate\Routing\Controller;
use Ihah\WebhookNotifier\Helpers\SlackFormatter;
use Ihah\WebhookNotifier\Notifiers\SlackNotifier;
use Ihah\WebhookNotifier\Http\Requests\GitlabRequest;

class SlackWebhookController extends Controller
{
    public function notify(GitlabRequest $request)
    {
        $client_token = $request->header('X_GITLAB_TOKEN');

        if (config('webhook-notifier.gitlab_token') != $client_token) {
            return response('Not authorized', 401);
        }

        try {
            $payload = (new SlackFormatter())->format($request->all());
        } catch (Exception $e) {
            return response($e->getMessage(), 400);
        }

        if (empty($payload)) {
            return response('Object type: ' . $request->get('object_kind') . ' is not supported', 400);
        }

        // Todo: Refactor to events and listeners
        (new SlackNotifier())->notify($payload, $request->get('object_kind'));

        return response('', 200);
    }
}
