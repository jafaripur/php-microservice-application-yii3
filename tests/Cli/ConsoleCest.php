<?php

declare(strict_types=1);

namespace Araz\Micro\Tests\Cli;

use Araz\Micro\Tests\CliTester;
use Yiisoft\Yii\Console\ExitCode;

final class ConsoleCest
{
    public function testCommandYii(CliTester $I): void
    {
        $command = dirname(__DIR__, 2) . '/yii_test';
        $I->runShellCommand($command);
        $I->seeInShellOutput('micro3-test');
    }

    public function testCommandTestIndex(CliTester $I): void
    {
        $command = dirname(__DIR__, 2) . '/yii_test';
        $I->runShellCommand($command . ' test/index');
        $I->seeInShellOutput('Hello');
        $I->seeResultCodeIs(ExitCode::OK);
    }
}
