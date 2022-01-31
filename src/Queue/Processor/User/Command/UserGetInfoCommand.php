<?php

declare(strict_types=1);

namespace Araz\Micro\Queue\Processor\User\Command;

use Araz\Micro\Queue\Processor\User\UserCommand;
use Araz\MicroService\ProcessorConsumer;
use Araz\MicroService\Queue;
use Psr\Log\LoggerInterface;

final class UserGetInfoCommand extends UserCommand
{
    public function __construct(Queue $queue, ProcessorConsumer $processorConsumer, LoggerInterface $logger)
    {
        parent::__construct($queue, $processorConsumer);
    }

    public function execute(mixed $body): mixed
    {
        return [
            'id' => 123,
            'name' => 'Test',
        ];
    }

    public function getJobName(): string
    {
        return 'get_profile_info';
    }
}
