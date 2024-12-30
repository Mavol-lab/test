<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Doctrine\DBAL\DriverManager;

/**
 * Create and configure the Doctrine EntityManager.
 */
function getEntityManager(): EntityManager
{
  // Validate environment variables
  $requiredEnvVars = ['DB_USER', 'DB_PASSWORD', 'DB_NAME', 'DB_HOST', 'APP_ENV'];
  foreach ($requiredEnvVars as $var) {
    if (empty($_ENV[$var])) {
      throw new RuntimeException("Environment variable '{$var}' is not set.");
    }
  }

  // Paths to entity mappings
  $paths = [realpath(__DIR__ . '/../src/Entity')];

  $isDevMode = $_ENV['APP_ENV'] == 'development';

  // Database connection parameters
  $dbParams = [
    'driver'   => 'pdo_mysql',
    'user'     => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASSWORD'],
    'dbname'   => $_ENV['DB_NAME'],
    'host'     => $_ENV['DB_HOST']
  ];

  // Configure Doctrine ORM
  $config = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);

  // Create connection and EntityManager
  $connection = DriverManager::getConnection($dbParams, $config);

  return new EntityManager($connection, $config);
}
