<?php

declare(strict_types=1);

namespace Araz\Micro\Queue\Consumer;

use Araz\MicroService\ProcessorConsumer;
use Generator;

final class ConsumerFirst extends ProcessorConsumer
{
    public function getConsumerIdentify(): string
    {
        return 'first-consumer';
    }

    /**
     * @inheritDoc
     */
    public function getProcessors(): Generator
    {
        // Command
        yield \Araz\Micro\Queue\Processor\User\Command\UserGetInfoCommand::class;

        // Emits
        yield \Araz\Micro\Queue\Processor\User\Emit\UserLoggedInEmit::class;

        // Topics
        yield \Araz\Micro\Queue\Processor\User\Topic\UserCreatedTopic::class;

        // Workers
        yield \Araz\Micro\Queue\Processor\User\Worker\UserProfileAnalysisWorker::class;

        yield \Araz\Micro\Queue\Processor\User\Worker\UserProfileUpdateNotificationWorker::class;
    }
}
