<?php

declare(strict_types=1);

use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\EventDispatcher\ListenerProviderInterface;
use Yiisoft\Aliases\Aliases;
use Yiisoft\EventDispatcher\Dispatcher\Dispatcher;
use Yiisoft\EventDispatcher\Provider\Provider;
use Yiisoft\EventDispatcher\Provider\ListenerCollection;
use Yiisoft\Yii\Event\ListenerCollectionFactory as Factory;

// @var array $params

return [
    EventDispatcherInterface::class => Dispatcher::class,
    ListenerProviderInterface::class => Provider::class,
    Aliases::class => [
        'class' => Aliases::class,
        '__construct()' => [
            [
                '@root' => dirname(__DIR__, 2),
                '@runtime' => '@root/runtime',
                '@src' => '@root/src',
                '@vendor' => '@root/vendor',
            ],
        ],
    ],
    ListenerCollection::class => static fn (Factory $factory) => $factory->create($config->get('events-console')),
];
