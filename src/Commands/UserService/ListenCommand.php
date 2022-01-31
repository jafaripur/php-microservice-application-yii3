<?php

declare(strict_types=1);

namespace Araz\Micro\Commands\UserService;

use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class ListenCommand extends Command
{
    protected static $defaultName = 'user-service/listen';
    protected static $defaultDescription = 'Listen on user-service queues';

    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct();

        $this->container = $container;
    }

    protected function configure(): void
    {
        $this->addArgument('consumers', InputArgument::OPTIONAL | InputArgument::IS_ARRAY, 'Consumer identity to run');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->container->get('user-service-queue')->getConsumer()->consume(0, (array)$input->getArgument('consumers'));
        return parent::SUCCESS;
    }
}
