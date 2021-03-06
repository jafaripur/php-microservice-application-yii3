<?php

declare(strict_types=1);

namespace Araz\Micro\Queue\Processor\User\Command;

use Araz\Micro\Queue\Processor\User\UserCommand;
use Araz\MicroService\Processors\RequestResponse\Request;
use Araz\MicroService\Processors\RequestResponse\Response;

final class UserGetInfoCommand extends UserCommand
{
    public function execute(Request $request): Response
    {
        return new Response([
            'id' => 123,
            'name' => 'Test',
        ]);
    }

    public function getJobName(): string
    {
        return 'get_profile_info';
    }
}
