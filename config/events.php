<?php

declare(strict_types=1);

use Psr\Log\LoggerInterface;
use Yiisoft\Yii\Console\Event\ApplicationShutdown;
use Yiisoft\Yii\Console\Event\ApplicationStartup;

return [
    ApplicationStartup::class => [
        //static fn (Timer $timer) => $timer->start('overall'),
        //static function (LoggerInterface $logger) {

        //},
    ],
    ApplicationShutdown::class => [
        static function (LoggerInterface $logger): void {
            /**
             * @var Queue $queue
             */
            //$queue->getContext()->close();
            $logger->info('Application shutdown.');
        },
    ],
];
