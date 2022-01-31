<?php

declare(strict_types=1);

namespace Araz\Micro\Commands\UserService;

use Araz\Service\User\UserService;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class SendTestCommand extends Command
{
    protected static $defaultName = 'user-service/send-test';
    protected static $defaultDescription = 'Send test messages';

    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct();

        $this->container = $container;
    }

    protected function configure(): void
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        /**
         * @var UserService
         */
        $userService = $this->container->get('user-service');

        $output->writeln("Sending async command to UserService::getUserInformation()");
        $userAsyncCommands = $userService->commands()->async(5000)
            ->getUserInformation(['id' => '123'], 'cor-test-1234', 2000)
            ->getUserInformation(['id' => '123'], 'cor-test-1235', 2000)
            ->getUserInformation(['id' => '123'], 'cor-test-1236', 2000);

        $output->writeln("Sending command to CommandSender::getUserInformation()\n");
        $result = $userService->commands()->getUserInformation(['id' => '123']);
        $output->writeln(print_r($result, true) . "\n\n");

        $output->writeln("Sending emit to EmitSender::userLoggedIn()\n");
        $msgId = $userService->emits()->userLoggedIn(['id' => '123']);
        $output->writeln(sprintf('Emit message ID: %s', $msgId));


        $output->writeln(sprintf("Sending topic to TopicSender::userLoggedIn() with routing key: %s", $userService->topics()->getRoutingKeyUserTopicCreate()));
        $msgId = $userService->topics()->userChanged($userService->topics()->getRoutingKeyUserTopicCreate(), ['id' => '123']);
        $output->writeln(sprintf('Topic message ID: %s', $msgId));

        $output->writeln(sprintf("Sending topic to TopicSender::userLoggedIn() with routing key: %s", $userService->topics()->getRoutingKeyUserTopicUpdate()));
        $msgId = $userService->topics()->userChanged($userService->topics()->getRoutingKeyUserTopicUpdate(), ['id' => '123']);
        $output->writeln(sprintf('Topic message ID: %s', $msgId));


        $output->writeln("Sending worker to WorkerSender::userProfileAnalysis()");
        $msgId = $userService->workers()->userProfileAnalysis(['id' => '123']);
        $output->writeln(sprintf('Worker message ID: %s', $msgId));

        $output->writeln("Sending worker to WorkerSender::userProfileUpdateNotification()");
        $msgId = $userService->workers()->userProfileUpdateNotification(['id' => '1234']);
        $output->writeln(sprintf('Worker message ID: %s', $msgId));

        $output->writeln("Receiving async command from UserService::getUserInformation ...");
        foreach ($userAsyncCommands->receive() as $correlationId => $data) {
            $output->writeln(print_r([$correlationId => $data], true));
        }

        return parent::SUCCESS;
    }
}
