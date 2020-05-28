<?php

namespace Ihah\GitlabWebhooks\Tests;

use Orchestra\Testbench\TestCase;
use Ihah\GitlabWebhooks\GitlabWebhooksServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [GitlabWebhooksServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
