<?php

declare(strict_types=1);

namespace Araz\Micro\Queue\Consumer;

use Araz\MicroService\ProcessorConsumer;
use Generator;

final class ConsumerSecond extends ProcessorConsumer
{
    public function getConsumerIdentify(): string
    {
        return 'second-consumer';
    }

    /**
     * @inheritDoc
     */
    public function getProcessors(): Generator
    {
        // Workers
        yield \Araz\Micro\Queue\Processor\User\Worker\UserProfileAnalysisWorker::class;
    }

    public function getPrefetchCount(): int
    {
        return 2;
    }
}
