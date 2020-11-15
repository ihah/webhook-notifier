# Very short description of the package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ihah/webhook-notifier.svg?style=flat-square)](https://packagist.org/packages/ihah/webhook-notifier)
[![Total Downloads](https://img.shields.io/packagist/dt/ihah/webhook-notifier.svg?style=flat-square)](https://packagist.org/packages/ihah/webhook-notifier)

Webhook-notifier package allows to receive GitLab/Github webhook payloads for Laravel application and send notifications to multiple Slack/Discord channels based on payload type.

One configuration to control all process, easy to setup.

# Packages status: ***under development***


# Installation

You can install the package via composer:

```bash
composer require ihah/webhook-notifier
```

**Publish config file**

```bash
php artisan vendor:publish --provider="Ihah\WebhookNotifier\WebhookNotifierServiceProvider" --tag=config
```




# Usage

## Gitlab + Slack

By default gitlab notification webhook for slack is: 

```
domain.com/gitlab/notify/slack
```

1. Define `GITLAB_TOKEN` in .env file. 
* `GITLAB_TOKEN` is used to check if request came from GitLab. 
* `GITLAB_TOKEN` should be set as webhook **secret token** in GitLab [More information about GitLab webhooks](https://docs.gitlab.com/ee/user/project/integrations/webhooks.html).

2. Config `../config/webhook-notifier.php` file
* Slack incomming webook urls should be always defined in .env file because they contain secret to your channel and can be blocked if they are leaked. [More information about Slack Incoming Webhooks](https://api.slack.com/messaging/webhooks)
* `all` array - send all supported notifications to defined channels
* `push` array - send all push notifications to defined channels


``` php
// .../config/webhook-notifier.php

'gitlab_token' => env('GITLAB_TOKEN'),
    'slack' => [
        'prefix' => 'gitlab/notify/',
        'middleware'=> [],
        'channels' => [
            'all' => [
                [
                    'name' => 'ricks-gitlab-channel',
                    'url' => env('RICKS_SLACK_CHANNEL_URL')
                ]
            ],

            'push' => [
                [
                    'name' => 'toms-gitlab-channel',
                    'url' => env('TOMS_SLACK_CHANNEL_URL')
                ],
                [
                    'name' => 'jams-gitlab-channel',
                    'url' => env('JAMS_SLACK_CHANNEL_URL')
                ],
            ]
        ],
    ],
```

### Testing

``` bash
composer test
```

## RoadMap:

**GitLab:**
- [x] GitLab push event
- [ ] GitLab issue event
- [ ] GitLab merge request event

**GitHub:**
- [ ] GitHub push event
- [ ] GitHub issue event
- [ ] GitHub merge request event

**Slack:**
- [x] GitLab push notification to multiple channels
- [ ] GitLab issue notification to multiple channels
- [ ] GitLab merge notification to multiple channels
- [ ] GitHub push notification to multiple channels
- [ ] GitHub issue notification to multiple channels
- [ ] GitHub merge notification to multiple channels

**Discord**:
- [ ] GitLab push notification to multiple channels
- [ ] GitLab issue notification to multiple channels
- [ ] GitLab merge notification to multiple channels
- [ ] GitHub push notification to multiple channels
- [ ] GitHub issue notification to multiple channels
- [ ] GitHub merge notification to multiple channels

**Other:**
- [ ] Support events and listeners
- [x] Send notifications using queues  


### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

### Security

If you discover any security related issues, please email ernestasdev@gmail.com instead of using the issue tracker.

## Credits

- [Ernestas](https://github.com/ihah)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
