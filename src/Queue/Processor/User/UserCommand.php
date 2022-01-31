<?php

declare(strict_types=1);

namespace Araz\Micro\Queue\Processor\User;

use Araz\MicroService\Processors\Command;

abstract class UserCommand extends Command
{
    public function getQueueName(): string
    {
        return 'user_service_command';
    }
}
