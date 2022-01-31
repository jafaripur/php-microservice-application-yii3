<?php

declare(strict_types=1);

namespace Araz\Micro\Queue\Processor\User;

use Araz\MicroService\Processors\Worker;

abstract class UserWorker extends Worker
{
    public function getQueueName(): string
    {
        return 'user_service_worker';
    }
}
