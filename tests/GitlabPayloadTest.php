<?php

namespace Ihah\WebhookNotifiers\Tests;

use Orchestra\Testbench\TestCase;
use Ihah\WebhookNotifier\Helpers\SlackFormatter;
use Ihah\WebhookNotifier\WebhookNotifierServiceProvider;
use Ihah\WebhookNotifier\Exceptions\KeyNotExistsInGitlabPayload;


class GitlabPayloadTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [WebhookNotifierServiceProvider::class];
    }

    /** @test */
    public function push_formatter_formats_correctly()
    {
        $path = __DIR__ . '/payloads/gitlab/push.json';
        $pushPayload = json_decode(file_get_contents($path), true);

        $formattedPayload = (new SlackFormatter())->format($pushPayload);

        $this->assertArrayHasKey('username', $formattedPayload);
        $this->assertArrayHasKey('text', $formattedPayload);
        $this->assertArrayHasKey('icon_emoji', $formattedPayload);
        $this->assertArrayHasKey('attachments', $formattedPayload);
    }

    /**
     * @test
     */
    public function missing_key_in_gitlab_push_payload()
    {
        $this->expectException(KeyNotExistsInGitlabPayload::class);
        $this->expectExceptionMessage('object_kind does not exits in gitlab payload.');

        // Empty payload from gitlab
        (new SlackFormatter())->format([]);
    }
}
