<?php

declare(strict_types=1);

use Monolog\Handler\SlackHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;
use Yiisoft\Definitions\DynamicReference;

/** @var array $params */

return [
    /*LoggerInterface::class => [
        /*'class' => Logger::class,
        '__construct()' => [
            $_ENV['APP_NAME'],
            [
                //DynamicReference::to([
                //    'class' => StreamHandler::class,
                //    '__construct()' => [
                //        'php://stdout',
                //        $_ENV["YII_DEBUG"] ? Logger::DEBUG : Logger::INFO
                //    ]
                //])

                DynamicReference::to(static function () {
                    return new StreamHandler('php://stdout', $_ENV["YII_DEBUG"] ? Logger::DEBUG : Logger::INFO);
                }),
            ],
            [],
            new \DateTimeZone($params['app']['tz'])
        ],
    ],*/
    LoggerInterface::class => DynamicReference::to(static function () use ($params) {
        $psrLogger = new Logger($_ENV['APP_NAME'], [
            new StreamHandler('php://stdout', $_ENV["YII_DEBUG"] ? Logger::DEBUG : Logger::ERROR),
        ], [], new \DateTimeZone($params['app']['tz']));

        if ($_ENV["SENTRY_DSN"]) {
            $client = \Sentry\ClientBuilder::create(['dsn' => $_ENV["SENTRY_DSN"]])->getClient();
            $psrLogger->pushHandler(new \Sentry\Monolog\Handler(new \Sentry\State\Hub($client)));
        }

        return $psrLogger;
    }),
];
