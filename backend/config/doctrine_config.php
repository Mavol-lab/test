<?php

use App\Helper\SQLLoggerMiddleware;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Doctrine\DBAL\DriverManager;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;

function getEntityManager(): EntityManager
{
  $paths = [dirname(__DIR__) . '/src/Entity'];  // Путь к сущностям
  $isDevMode = true; // Для разработки

  // Параметры подключения к базе данных
  $dbParams = [
    'driver'   => 'pdo_mysql',
    'user'     => 'freedb_mavol',
    'password' => '6bt@ppG3yMU*DMC',
    'dbname'   => 'freedb_test_databaseeeee',
    'host'     => 'sql.freedb.tech'
  ];

  $logger = new Logger('doctrine_sql');
  $logger->pushHandler(new StreamHandler(dirname(__DIR__) . '/logs/doctrine.log', Level::Debug));

  // Создание конфигурации Doctrine с атрибутами
  $config = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);

  // Подключение к базе данных
  $connection = DriverManager::getConnection($dbParams, $config);
  $connection->getConfiguration()->setMiddlewares([new SQLLoggerMiddleware($logger)]);

  // Создание EntityManager
  return new EntityManager($connection, $config);
}
