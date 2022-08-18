<?php

declare(strict_types=1);

namespace Araz\Micro;

use FilesystemIterator as FSIterator;
use RecursiveDirectoryIterator as DirIterator;
use RecursiveIteratorIterator as RIterator;

final class Installer
{
    public static function postUpdate(): void
    {
        self::chmodRecursive('runtime', 0o777);
    }

    public static function copyEnvFile(): void
    {
        if (!file_exists('.env')) {
            copy('.env.example', '.env');
        }

        if (!file_exists('.env_test')) {
            copy('.env.example', '.env_test');
        }

        if (!file_exists('config/env/dev.app.php')) {
            copy('config/env/config.example.php', 'config/env/dev.app.php');
        }

        if (!file_exists('config/env/prod.app.php')) {
            copy('config/env/config.example.php', 'config/env/prod.app.php');
        }
    }

    public static function compileClassMap(): void
    {
        $files = require __DIR__ . '/../vendor/composer/autoload_classmap.php';

        foreach (array_unique($files) as $file) {
            opcache_compile_file($file);
        }
    }

    private static function chmodRecursive(string $path, int $mode): void
    {
        chmod($path, $mode);
        $iterator = new RIterator(
            new DirIterator($path, FSIterator::SKIP_DOTS | FSIterator::CURRENT_AS_PATHNAME),
            RIterator::SELF_FIRST
        );

        /**
         * @var string $item
         */
        foreach ($iterator as $item) {
            chmod($item, $mode);
        }
    }
}
