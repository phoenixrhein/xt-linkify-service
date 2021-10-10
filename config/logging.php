<?php

return [
    'default' => 'logger',
    'channels' => [
        'logger' => [
            'driver' => 'single',
            'path' => storage_path('logs/test.log'),
            'level' => Psr\Log\LogLevel::INFO,
            'formatter' => de\xovatec\linkify\Logging\Formatter\DefaultFormatter::class,
            'tap' => [de\xovatec\linkify\Logging\Interceptor::class],
        ],
    ],
];
