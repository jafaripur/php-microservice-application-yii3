<?php

declare(strict_types=1);

return [
    'app' => [
        'tz' => 'UTC',
    ],
    'yiisoft/yii-console' => [
        'name' => $_ENV['APP_NAME'],
        'version' => '0.0.1',
        'autoExit' => false,
        'commands' => [
            'test/index|test' => \Araz\Micro\Commands\Test\IndexCommand::class,

            'user-service/listen' => \Araz\Micro\Commands\UserService\ListenCommand::class,
            'user-service/send-test' => \Araz\Micro\Commands\UserService\SendTestCommand::class,
        ],
    ],
];
