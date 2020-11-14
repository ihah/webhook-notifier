<?php

namespace Ihah\WebhookNotifier\Http\Controllers;

use Exception;
use Illuminate\Routing\Controller;
use Ihah\WebhookNotifier\Helpers\SlackFormatter;
use Ihah\WebhookNotifier\Http\Requests\GitlabRequest;
use Ihah\WebhookNotifier\Jobs\SendSlackNotifications;

class SlackWebhookController extends Controller
{
    public function notify(GitlabRequest $request)
    {
        try {
            $payload = (new SlackFormatter())->format($request->all());
        } catch (Exception $e) {
            return response($e->getMessage(), 400);
        }

        if (empty($payload)) {
            return response('Object type: ' . $request->get('object_kind') . ' is not supported', 400);
        }
        
        SendSlackNotifications::dispatch($payload, $request->get('object_kind'));

        return response('', 200);
    }
}
