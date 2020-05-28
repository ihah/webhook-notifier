<?php

namespace Ihah\GitlabWebhooks;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Ihah\GitlabWebhooks\Skeleton\SkeletonClass
 */
class GitlabWebhooksFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'gitlab-webhooks';
    }
}
