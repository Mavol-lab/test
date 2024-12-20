<?php

namespace App\Helper;

use Doctrine\DBAL\Driver\Middleware as DriverMiddleware;
use Doctrine\DBAL\Driver;
use Psr\Log\LoggerInterface;

class SQLLoggerMiddleware implements DriverMiddleware
{
  private LoggerInterface $logger;

  public function __construct(LoggerInterface $logger)
  {
    $this->logger = $logger;
  }

  public function wrap(Driver $driver): Driver
  {
    // Вернуть драйвер с логированием (может потребоваться дополнительная логика для обертки)
    return new class($driver, $this->logger) implements Driver {
      private Driver $driver;
      private LoggerInterface $logger;

      public function __construct(Driver $driver, LoggerInterface $logger)
      {
        $this->driver = $driver;
        $this->logger = $logger;
      }

      public function connect(array $params): \Doctrine\DBAL\Driver\Connection
      {
        $this->logger->info('Устанавливается соединение с базой данных', $params);
        return $this->driver->connect($params);
      }

      public function startQuery($sql, array $params = null, array $types = null)
      {
        $this->logger->info('SQL Query: ' . $sql, [
          'params' => $params,
          'types' => $types
        ]);
      }

      // Здесь можно переопределить другие методы при необходимости
    };
  }
}
