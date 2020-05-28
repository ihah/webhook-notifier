<?php

namespace Ihah\WebhookNotifier\Formaters\Slack;

use Ihah\WebhookNotifier\Helpers\PayloadChecker;
use Ihah\WebhookNotifier\Exceptions\KeyNotExistsInGitlabPayload;

class PushFormatter
{
    private $bot_name = 'Gitlab';
    private $icon     = ':pushpin:';
    private $message;
    private $attachments = [];

    protected $requiredPayloadKeys = ['object_kind', 'user_name', 'project', 'commits'];


    public function format(array $payload)
    {
        PayloadChecker::check($this->requiredPayloadKeys, $payload);

        $data = [
            // 'channel'     => $this->channel,
            'username'    => $this->bot_name,
            'text'        => $this->formatMessage($payload['object_kind'], $payload['user_name'], $payload['project']['name'])->message,
            'icon_emoji'  => $this->icon,
            'attachments' => $this->formatAttachments($payload['commits'])->attachments,
        ];

        return $data;
    }

    private function formatMessage(string $trigger, string $username, string $projectName)
    {
        $this->message = "Project: " . $projectName . "\nTrigger: " . $trigger . "\nUser: " . $username;
        return $this;
    }

    private function formatAttachments(array $commits)
    {
        foreach ($commits as $key => $commit) {
            $this->attachments[$key] = [
                "fallback" => $commit['message'],
                "color" => "#36a64f",
                "author_name" => $commit['author']['name'],
                "title" => $commit['message'],
                "title_link" => $commit['url'],
                "ts" => strtotime($commit['timestamp'])
            ];
        }
        return $this;
    }
}
