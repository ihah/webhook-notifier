<?php

/*
 * You can place your custom package configuration in here.
 * 
 * Keep URL parameter secret
 * URL parameter contains secrets from your slack channel
 */
return [
    'gitlab_token' => env('GITLAB_TOKEN'),
    'slack' => [
        'channels' => [
            'all' => [
                [
                    'name' => 'channel-name',
                    'url' => env('SLACK_CHANNEL_URL')
                ]
            ],

            'push' => [
                [
                    'name' => 'channel-name',
                    'url' => env('SLACK_CHANNEL_URL')
                ]
            ]
        ],
    ],
];
