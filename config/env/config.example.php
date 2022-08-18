<?php

declare(strict_types=1);

use Araz\MicroService\AmqpConnection;
use Araz\Service\User\UserService;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Yiisoft\Definitions\Reference;

return [
    'microservice-queue' => [
        'class' => AmqpConnection::class,
        '__construct()' => [
            [
                'dsn' => $_ENV['QUEUE_AMQP_DSN'],
                'lazy' => true,
                'persisted' => true,
                'heartbeat' => 10,
                'qos_prefetch_count' => 1,
            ],
        ],
    ],
    'user-service-queue' => [
        'class' => \Araz\MicroService\Queue::class,
        '__construct()' => [
            'micro-test-app',
            Reference::to('microservice-queue'),
            Reference::to(LoggerInterface::class),
            Reference::to(ContainerInterface::class),
            true,
            true,
            [
                Araz\Micro\Queue\Consumer\ConsumerFirst::class,
                Araz\Micro\Queue\Consumer\ConsumerSecond::class,
            ],
        ],
    ],

    UserService::class => [
        'class' => \Araz\Service\User\UserService::class,
        '__construct()' => [
            Reference::to('user-service-queue'),
        ],
    ],

    /*'user-service-queue' => DynamicReference::to(static function (ContainerInterface $container, LoggerInterface $logger) {
        return new Queue(
            Reference::to('microservice-queue'),
            $logger,
            $container,
            true,
            true,
            [
                Araz\Micro\Queue\Consumers\ConsumerFirst::class,
                Araz\Micro\Queue\Consumers\ConsumerSecond::class,
            ],
        );
    }),*/
];
