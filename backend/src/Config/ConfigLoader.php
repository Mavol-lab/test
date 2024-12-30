<?php

namespace App\Config;

use Dotenv\Dotenv;

class ConfigLoader
{
    public static function load(string $baseDir): void
    {
        // Load dotenv lbry
        $dotenv = Dotenv::createImmutable($baseDir);
        $dotenv->load();

        // Import base configurations
        require_once $baseDir . '/config/doctrine_config.php';
        require_once $baseDir . '/config/purifier_config.php';
    }
}
