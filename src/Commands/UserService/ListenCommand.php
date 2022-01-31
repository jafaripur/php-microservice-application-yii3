<?php

declare(strict_types=1);

namespace Araz\Micro\Commands\UserService;

use Araz\Service\User\UserService;
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
        $this->addArgument('methods', InputArgument::OPTIONAL | InputArgument::IS_ARRAY, 'Consumer identity to run');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        /**
         * @var UserService
         */
        $this->container->get('user-service')->listen($input->getArgument('methods'));

        return parent::SUCCESS;
    }
}
