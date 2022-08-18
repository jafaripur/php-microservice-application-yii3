<?php

declare(strict_types=1);

namespace Araz\Micro\Commands\Test;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class IndexCommand extends Command
{
    protected static $defaultName = 'test/index';

    protected static $defaultDescription = 'Test command';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Hello');

        return parent::SUCCESS;
    }
}
