<?php

declare(strict_types=1);

namespace Araz\Micro\Queue\Processor\User\Worker;

use Araz\Micro\Queue\Processor\User\UserWorker;

final class UserProfileUpdateNotificationWorker extends UserWorker
{
    public function execute(mixed $body): void
    {
    }

    public function getJobName(): string
    {
        return 'user_profile_update_notification';
    }
}
