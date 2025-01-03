<?php

namespace App\Managers;

use App\Utils\ExceptionCode;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Doctrine\DBAL\DriverManager;

/**
 * This class is responsible for managing Doctrine ORM operations.
 */
class DoctrineManager
{
    /**
     * Retrieves the EntityManager instance.
     */
    public static function getEntityManager(): EntityManager
    {
        // Validate environment variables
        $requiredEnvVars = ['DB_USER', 'DB_PASSWORD', 'DB_NAME', 'DB_HOST', 'APP_ENV'];

        foreach ($requiredEnvVars as $var) {
            if (!isset($_ENV[$var]) || $_ENV[$var] === '') {
                throw new ExceptionCode(500, "Internal server error");
            }
        }

        // Paths to entity mappings
        $paths = [realpath(__DIR__ . '/../../src/Models')];

        $isDevMode = isset($_ENV['APP_ENV']) && $_ENV['APP_ENV'] == 'development';

        // Database connection parameters
        $dbParams = [
            'driver'   => 'pdo_mysql',
            'user'     => $_ENV['DB_USER'] ?? '',
            'password' => $_ENV['DB_PASSWORD'] ?? '',
            'dbname'   => $_ENV['DB_NAME'] ?? '',
            'host'     => $_ENV['DB_HOST'] ?? '',
            'charset'  => 'utf8mb4',
            'port'     => 3306
        ];

        // Configure Doctrine ORM
        $config = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);

        // Create connection and EntityManager
        $connection = DriverManager::getConnection($dbParams, $config);

        return new EntityManager($connection, $config);
    }
}
